
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Student Profile</h4>
                </div>
            </div>
            <!-- /.row -->
            <!-- .row -->
            <div class="white-box">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <asp:Button runat="server" ID="CheckAll" OnClick="CheckAll_Click" CssClass="btn btn-info btn-block" Text="Check All" />
                    </div>
                    <div class="col-md-3">
                        <asp:Button runat="server" ID="submit" CssClass="btn btn-success btn-block" OnClick="submit_Click" Text="Submit" />
                    </div>
                    <p>
                         <h3>Outstandings</h3>
                    </p>
                   
                    <asp:GridView ID="outStd" runat="server" EmptyDataText="NO DATA" CssClass="table table-hover table-striped" GridLines="None" AutoGenerateColumns="false">
                        <Columns>
                            <asp:TemplateField HeaderText="Select">
                                <ItemTemplate>
                                    <asp:CheckBox ID="Crs" runat="server" CssClass="input-lg" Checked="true" Enabled="false" />

                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:BoundField DataField="DepartmantID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCode" HeaderText="Subject Code" />
                            <asp:BoundField DataField="SubjectID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectName" HeaderText="Subject Name" />
                            <asp:BoundField DataField="SubjectCombinID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCombinName" HeaderText="Subject Combination" />
                            <asp:BoundField DataField="SubjectValue" HeaderText="Subject Value" />
                            <asp:BoundField DataField="SubjectUnit" HeaderText="Subject Unit" />
                           
                             <asp:BoundField DataField="SubjectLevel"  ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SessionID"  ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="Semester"  ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                        </Columns>

                    </asp:GridView>

                    <p>
                        <h3>CARRYOVERS</h3>
                    </p>
                    <asp:GridView ID="carryOver"  runat="server" Width="100%" EmptyDataText="No Data" CssClass="table table-hover table-striped" GridLines="None" AutoGenerateColumns="false">
                        <Columns>
                            <asp:TemplateField HeaderText="Select">
                                <ItemTemplate>
                                    <asp:CheckBox ID="Crs" runat="server" CssClass="input-lg" Checked="true" Enabled="false" />
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:BoundField DataField="DepartmantID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCode" HeaderText="Subject Code"  />
                            <asp:BoundField DataField="SubjectID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectName" HeaderText="Subject Name" />
                            <asp:BoundField DataField="SubjectCombinID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCombinName" HeaderText="Subject Combination" />
                            <asp:BoundField DataField="SubjectValue" HeaderText="Subject Value" />
                            <asp:BoundField DataField="SubjectUnit" HeaderText="Subject Unit" />
                            <asp:BoundField DataField="Semester" HeaderText="Semester" HeaderStyle-CssClass="hiddencol" />
                        </Columns>
                        <RowStyle CssClass="cursor-pointer" />


                    </asp:GridView>
                    <hr />
                    <p>
                        <h3>1st Semester</h3>
                    </p>
                    <asp:GridView ID="allSubject" runat="server" CssClass="table table-hover table-striped" GridLines="None" AutoGenerateColumns="false">
                        <Columns>
                            <asp:TemplateField HeaderText="Select">
                                <ItemTemplate>
                                    <asp:CheckBox ID="Crs" runat="server" CssClass="input-lg" />

                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:BoundField DataField="DepartmantID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCode" HeaderText="Subject Code" />
                            <asp:BoundField DataField="SubjectID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectName" HeaderText="Subject Name" />
                            <asp:BoundField DataField="SubjectCombinID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCombinName" HeaderText="Subject Combination" />
                            <asp:BoundField DataField="SubjectValue" HeaderText="Subject Value" />
                            <asp:BoundField DataField="SubjectUnit" HeaderText="Subject Unit" />
                        </Columns>

                    </asp:GridView>
                    <hr />
                    <p>
                        <h3>2nd Semester</h3>
                    </p>
                    <asp:GridView ID="allSubjectII" CssClass="table table-hover table-striped" GridLines="None" runat="server" AutoGenerateColumns="false">
                        <Columns>
                            <asp:TemplateField HeaderText="Select">
                                <ItemTemplate>
                                    <asp:CheckBox ID="Crs" runat="server" CssClass="input-lg" />

                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:BoundField DataField="DepartmantID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCode" HeaderText="Subject Code" />
                            <asp:BoundField DataField="SubjectID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectName" HeaderText="Subject Name" />
                            <asp:BoundField DataField="SubjectCombinID" ItemStyle-CssClass="hiddencol" HeaderStyle-CssClass="hiddencol" />
                            <asp:BoundField DataField="SubjectCombinName" HeaderText="Subject Combination" />
                            <asp:BoundField DataField="SubjectValue" HeaderText="Subject Value" />
                            <asp:BoundField DataField="SubjectUnit" HeaderText="Subject Unit" />
                        </Columns>

                    </asp:GridView>
                </div>
            </div>
        </div>
    </div>


