using School365.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using EntityFramework.Extensions;


namespace School365.Students
{
    public partial class UserRegister : System.Web.UI.Page
    {
        StudentModel db = new StudentModel();
        Util util = new Util();
        // public List<Result> db.Results = new List<Result>();
        public int value = 0;
        int getStudentID = 0;
        int SubCombID = 0;
        double Level = 0;
        double gettotalTNU = 0;
        double gettotalTNUII = 0;
        double getCarryOverTnu = 0;
        double getCarryOverTnuII = 0;
        int outTnu = 0;
        string matricNo = "";
        int getSessionID = 0;

        int StudentID = 0;
        int StudentCurricullumID = 0;
        // StdGen user = new StdGen();
        StudentInfo user = new StudentInfo();
        protected void Page_Load(object sender, EventArgs e)
        {
            if (User.Identity.IsAuthenticated == false)
                Response.Redirect("UserLogin.aspx");
            StudentID = int.Parse(User.Identity.Name);
            user.UserInfo(StudentID);

            if (user.UserInfo(StudentID).StudentAddress == "" || user.UserInfo(StudentID).StudentAddress == null)
                Response.Redirect("UserEdit.aspx");
            value = user.UserInfo(StudentID).StudentID;

            if (user.UserInfo(StudentID).IsProbation == true)
            {
                Response.Redirect("UserEdit.aspx");
            }
            bool check = util.CheckBed(StudentID);
            if (check == true && user.UserInfo(StudentID).SubCourse == null)
                Response.Redirect("SubCourseRegistration.aspx");
            if (!IsPostBack)
            {
                // db.Results = (from d in db.Results select d).ToList();
                string Major = "";
                string Minor = "";
                string subComb = "";
                var getValues = (from d in db.Students
                                 where d.StudentID == value
                                 select new { d.Major, d.Minor, d.StudentID, d.Level, d.Registered, d.MatricNo, d.CurriculumID }).First();


                if (getValues.Registered.ToUpper() == "TRUE")
                {
                    allSubject.Visible = false;
                    allSubjectII.Visible = false;
                    submit.Visible = false;
                    CheckAll.Visible = false;
                    carryOver.Visible = false;
                }
                Major = getValues.Major;
                Minor = getValues.Minor;
                Level = getValues.Level;
                getStudentID = getValues.StudentID;
                matricNo = getValues.MatricNo;
                subComb = Major + "/" + Minor;

                var getSubCombID = (from d in db.SubjectCombinations where d.SubjectCombinName == subComb select d.SubjectCombinID).First();
                //Trying to access it below for button
                SubCombID = getSubCombID;
                if (getSubCombID == 0)
                {
                    Response.Write("Subject Combination not found....please contact Admin");
                }
                else
                {
                    //for carryovers
                    var getCarryOvers = from r in db.Results
                                        where r.StudentID == getStudentID
                                        join d in db.CarryOvers on r.ResultID equals d.ResultID
                                        join f in db.Departments on r.DepartmentID equals f.DepartmantID
                                        join a in db.Subjects on r.SubjectID equals a.SubjectID
                                        join s in db.SubjectCombinations on r.SubjectCombinID equals s.SubjectCombinID
                                        select new { s.SubjectCombinID, s.SubjectCombinName, f.DepartmantID, a.SubjectID, a.SubjectName, a.SubjectValue, a.SubjectCode, a.SubjectUnit, a.Semester };
                    carryOver.DataSource = getCarryOvers.OrderBy(a => a.DepartmantID).Distinct().ToList();
                    carryOver.DataBind();

                    StudentCurricullumID = (int)getValues.CurriculumID;

                    var getAllSubject = from a in db.AllCombineds
                                        where a.SubjectCombineID == getSubCombID && a.CurricullumID == StudentCurricullumID
                                        join j in db.SubjectCombinations on a.SubjectCombineID equals j.SubjectCombinID
                                        join d in db.Departments on a.DepartmentID equals d.DepartmantID
                                        join h in db.Subjects on a.SubjectID equals h.SubjectID
                                        select new { j.SubjectCombinID, j.SubjectCombinName, d.DepartmantID, h.SubjectCode, h.SubjectID, h.SubjectName, h.SubjectValue, h.SubjectUnit, h.SubjectLevel, h.Semester, h.Active };

                    var getSubjectbyLevel = from d in getAllSubject where d.SubjectLevel == getValues.Level.ToString() && d.Active == true && d.Semester == "1" select d;

                    // Response.Write(getSubjectbyLevel.Count());

                    allSubject.DataSource = getSubjectbyLevel.OrderBy(a => a.DepartmantID).ToList();
                    allSubject.DataBind();

                    var getSubjectbyLevelII = from d in getAllSubject where d.SubjectLevel == getValues.Level.ToString() && d.Active == true && d.Semester == "2" select d;
                    allSubjectII.DataSource = getSubjectbyLevelII.OrderBy(a => a.DepartmantID).ToList();
                    allSubjectII.DataBind();

                    getOut(value, SubCombID);
                    //getOutstanding(value);
                }
            }
        }


        protected void submit_Click(object sender, EventArgs e)
        {
            int _studentID = int.Parse(HttpContext.Current.Session["StudentID"].ToString());
            var _allUserInfo = user.UserInfo(StudentID);
            string _matricNo = _allUserInfo.MatricNo;
            double _level = _allUserInfo.Level;
            //var getValues = (from d in db.Students
            //                 where d.StudentID == _studentID
            //                 select new { d.Major, d.Minor, d.StudentID, d.Level, d.Registered, d.MatricNo }).First();



            getSessionID = (from d in db.Sessions where d.CurrentSession == true select d.SessionID).FirstOrDefault();
            foreach (GridViewRow rows in carryOver.Rows)
            {
                int SubjectID = int.Parse(rows.Cells[3].Text);
                var getSemester = (from d in db.Subjects where d.SubjectID == SubjectID select new { d.Semester, d.SubjectCode }).FirstOrDefault();
                if (getSemester.Semester == "1")
                {
                    getCarryOverTnu += double.Parse(rows.Cells[7].Text);
                }
                else
                {
                    getCarryOverTnuII += double.Parse(rows.Cells[7].Text);
                }
            }
            foreach (GridViewRow rows in allSubject.Rows)
            {
                if ((rows.Cells[0].FindControl("Crs") as CheckBox).Checked)
                {
                    gettotalTNU += double.Parse(rows.Cells[7].Text);
                }
            }

            foreach (GridViewRow rows in allSubjectII.Rows)
            {
                if ((rows.Cells[0].FindControl("Crs") as CheckBox).Checked)
                {
                    gettotalTNUII += double.Parse(rows.Cells[7].Text);
                }
            }
            int min, max, _min, _max = 0;
            int tc, _tc = 0;
            max = NewUtil.MaxGrade((int)user.UserInfo(StudentID).Level, 1, SubCombID);
            min = NewUtil.MinGrade((int)user.UserInfo(StudentID).Level, 1, SubCombID);
            _min = NewUtil.MinGrade((int)user.UserInfo(StudentID).Level, 2, SubCombID);
            _max = NewUtil.MaxGrade((int)user.UserInfo(StudentID).Level, 2, SubCombID);

            tc = (int)(gettotalTNU + getCarryOverTnu + outTnu);
            _tc = (int)(gettotalTNUII + getCarryOverTnuII);

            if ((tc > max || tc < min))
            {
                Response.Write("YOU EXCEEDED YOUR UNIT FOR FIRST SEMESTER");
            }
            if (_tc > _max || tc < _min)
            {
                Response.Write("YOU EXCEEDED YOUR UNIT FOR SECOND SEMESTER");
            }
            foreach (GridViewRow rows in allSubject.Rows)
            {
                if ((rows.Cells[0].FindControl("Crs") as CheckBox).Checked)
                {
                    var InsertResult = new Result
                    {
                        MatricNo = _matricNo,
                        StudentID = _studentID,
                        SubjectCombinID = int.Parse(rows.Cells[5].Text),
                        DepartmentID = int.Parse(rows.Cells[1].Text),
                        SubjectID = int.Parse(rows.Cells[3].Text),
                        Level = _level,
                        TNU = double.Parse(rows.Cells[7].Text),
                        SessionID = getSessionID,
                        Semester = 1,

                    };

                    db.Results.Add(InsertResult);
                    db.SaveChanges();
                    allSubject.Visible = false;
                }
            }
            foreach (GridViewRow rows in allSubjectII.Rows)
            {
                if ((rows.Cells[0].FindControl("Crs") as CheckBox).Checked)
                {
                    var InsertResult = new Result
                    {
                        StudentID = _studentID,
                        MatricNo = _matricNo,
                        SubjectCombinID = int.Parse(rows.Cells[5].Text),
                        DepartmentID = int.Parse(rows.Cells[1].Text),
                        SubjectID = int.Parse(rows.Cells[3].Text),
                        Level = _level,
                        TNU = double.Parse(rows.Cells[7].Text),
                        SessionID = getSessionID,
                        Semester = 2,
                    };
                    db.Results.Add(InsertResult);
                    db.SaveChanges();
                    allSubject.Visible = false;
                }
            }

            foreach (GridViewRow rows in carryOver.Rows)
            {
                var InsertCarryOver = new Result
                {
                    StudentID = _studentID,
                    MatricNo = _matricNo,
                    SubjectCombinID = int.Parse(rows.Cells[5].Text),
                    DepartmentID = int.Parse(rows.Cells[1].Text),
                    SubjectID = int.Parse(rows.Cells[3].Text),
                    Level = _level,
                    TNU = double.Parse(rows.Cells[7].Text),
                    SessionID = getSessionID,
                    Semester = int.Parse(rows.Cells[9].Text),
                };
                db.Results.Add(InsertCarryOver);
                db.SaveChanges();
                carryOver.Visible = false;
            }
            CalcOutstanding();
            var UpdateStudent = (from d in db.Students where d.StudentID == _studentID select d).FirstOrDefault();
            UpdateStudent.Registered = "True";
            db.SaveChanges();
            CalcLastValues();
            string parameter = "grab=" + value;
            Response.Redirect("CourseForm.aspx?" + parameter);
        }
        private void CalcLastValues()
        {
            double getLevel = (from d in db.Students where d.StudentID == getStudentID select d.Level).FirstOrDefault();
            double getLastLevel = getLevel - 100;
            if (getLastLevel != 0)
            {
                var getOldSession = (from d in db.Results where d.StudentID == getStudentID && d.Level == getLastLevel select d.SessionID).FirstOrDefault();
                var getPrevDept = (from d in db.Results
                                   where d.StudentID == getStudentID && d.SessionID == getOldSession
                                   select d.DepartmentID).Distinct().ToList();
                foreach (var setPrevDept in getPrevDept)
                {
                    var previousTnup = (from d in db.Results where d.StudentID == getStudentID && d.SessionID == getOldSession && d.DepartmentID == setPrevDept && (d.EXAM + d.CA) >= 50 select d.TNUP).Distinct().FirstOrDefault();
                    db.Results.Where(x => x.StudentID == getStudentID && x.DepartmentID == setPrevDept && x.SessionID == getSessionID).Update(x => new Result() { TNUP = previousTnup });
                }

            }
        }
        protected void CheckAll_Click(object sender, EventArgs e)
        {
            foreach (GridViewRow item in allSubject.Rows)
            {
                if ((item.Cells[0].FindControl("Crs") as CheckBox).Checked == false)
                {
                    (item.Cells[0].FindControl("Crs") as CheckBox).Checked = true;
                }
            }

            foreach (GridViewRow item in allSubjectII.Rows)
            {
                if ((item.Cells[0].FindControl("Crs") as CheckBox).Checked == false)
                {
                    (item.Cells[0].FindControl("Crs") as CheckBox).Checked = true;
                }
            }
        }

        private void getOut(int StudentID, int SubCombID)
        {
            outStd.DataSource = util.GetOutstanding(StudentID, SubCombID);
            outStd.DataBind();

        }
        private void CalcOutstanding()
        {
            int Tnu = 0;
            outTnu = outTnu + Tnu;
            foreach (GridViewRow rows in outStd.Rows)
            {
                if ((rows.Cells[0].FindControl("Crs") as CheckBox).Checked)
                {
                    int DeptId = int.Parse(rows.Cells[1].Text);
                    int SubjId = int.Parse(rows.Cells[3].Text);

                    int SubCombID = int.Parse(rows.Cells[5].Text);
                    Tnu = int.Parse(rows.Cells[7].Text);
                    double Level = double.Parse(rows.Cells[9].Text);
                    int SessionID = int.Parse(rows.Cells[10].Text);
                    int Semester = int.Parse(rows.Cells[11].Text);
                    var InsertResult = new Result
                    {
                        StudentID = getStudentID,
                        MatricNo = matricNo,
                        DepartmentID = DeptId,
                        SubjectID = SubjId,
                        SubjectCombinID = SubCombID,
                        TNU = Tnu,
                        Level = Level,

                        SessionID = getSessionID,
                        Semester = Semester,
                        OutStandingCheck = true
                    };
                    db.Results.Add(InsertResult);
                    db.SaveChanges();
                    outTnu = outTnu + Tnu;
                }

                //var UpdateOut=from d in db.OutStandings where d.OutstandingID==
            }
            var getAllOut = (from d in db.OutStandings where d.StudentID == value && d.Registered == false select d).FirstOrDefault();
            if (getAllOut != null)
            {
                getAllOut.Registered = true;
                db.SaveChanges();
            }

            outStd.Visible = false;

        }



    }
}