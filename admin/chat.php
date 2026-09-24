<?php include 'include/header.php'; ?>
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="card chat-sidebar-container" data-sidebar-container="chat">
                    <div class="chat-sidebar-wrap" data-sidebar="chat">
                        <div class="border-right">
                            <div class="pt-2 pb-2 pl-3 pr-3 d-flex align-items-center o-hidden box-shadow-1 chat-topbar"><a class="link-icon d-md-none" data-sidebar-toggle="chat"><i class="icon-regular ml-0 mr-3 i-Left"></i></a>
                                <div class="form-group m-0 flex-grow-1">
                                    <input class="form-control form-control-rounded" id="search" type="text" placeholder="Search contacts" />
                                </div>
                            </div>
                            <div class="contacts-scrollable perfect-scrollbar">
                                <div class="mt-4 pb-2 pl-3 pr-3 font-weight-bold text-muted border-bottom">Recent</div>
                                <div class="p-3 d-flex align-items-center border-bottom online contact"><img class="avatar-sm rounded-circle mr-3" src="images/13.jpg" alt="alt" />
                                    <div>
                                        <h6 class="m-0">Frank Powell</h6><span class="text-muted text-small">3 Oct, 2018</span>
                                    </div>
                                </div>
                                <div class="mt-3 pb-2 pl-3 pr-3 font-weight-bold text-muted border-bottom">Contacts</div>
                                <div class="p-3 d-flex border-bottom align-items-center contact online"><img class="avatar-sm rounded-circle mr-3" src="images/3.jpg" alt="alt" />
                                    <h6>William Wills</h6>
                                </div>
                                <div class="p-3 d-flex border-bottom align-items-center contact online"><img class="avatar-sm rounded-circle mr-3" src="images/4.jpg" alt="alt" />
                                    <h6>Jaqueline Day</h6>
                                </div>
                                <div class="p-3 d-flex border-bottom align-items-center contact"><img class="avatar-sm rounded-circle mr-3" src="images/5.jpg" alt="alt" />
                                    <h6>Jhone Will</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-wrap" data-sidebar-content="chat">
                        <div class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden box-shadow-1 chat-topbar"><a class="link-icon d-md-none" data-sidebar-toggle="chat"><i class="icon-regular i-Right ml-0 mr-3"></i></a>
                            <div class="d-flex align-items-center"><img class="avatar-sm rounded-circle mr-2" src="images/13.jpg" alt="alt" />
                                <p class="m-0 text-title text-16 flex-grow-1">Frank Powell</p>
                            </div>
                        </div>
                        <div class="chat-content perfect-scrollbar" data-suppress-scroll-x="true">
                            <div class="d-flex mb-4">
                                <div class="message flex-grow-1">
                                    <div class="d-flex">
                                        <p class="mb-1 text-title text-16 flex-grow-1">Frank Powell</p><span class="text-small text-muted">25 min ago</span>
                                    </div>
                                    <p class="m-0">Do you ever find yourself falling into the “discount trap?</p>
                                </div><img class="avatar-sm rounded-circle ml-3" src="images/13.jpg" alt="alt" />
                            </div>
                            <div class="d-flex mb-4 user"><img class="avatar-sm rounded-circle mr-3" src="images/1.jpg" alt="alt" />
                                <div class="message flex-grow-1">
                                    <div class="d-flex">
                                        <p class="mb-1 text-title text-16 flex-grow-1">Jhon Doe</p><span class="text-small text-muted">24 min ago</span>
                                    </div>
                                    <p class="m-0">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="message flex-grow-1">
                                    <div class="d-flex">
                                        <p class="mb-1 text-title text-16 flex-grow-1">Frank Powell</p><span class="text-small text-muted">25 min ago</span>
                                    </div>
                                    <p class="m-0">Do you ever find yourself falling into the “discount trap?</p>
                                </div><img class="avatar-sm rounded-circle ml-3" src="images/13.jpg" alt="alt" />
                            </div>
                            <div class="d-flex mb-4 user"><img class="avatar-sm rounded-circle mr-3" src="images/1.jpg" alt="alt" />
                                <div class="message flex-grow-1">
                                    <div class="d-flex">
                                        <p class="mb-1 text-title text-16 flex-grow-1">Jhon Doe</p><span class="text-small text-muted">24 min ago</span>
                                    </div>
                                    <p class="m-0">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
                            <form class="inputForm">
                                <div class="form-group">
                                    <textarea class="form-control form-control-rounded" id="message" placeholder="Type your message" name="message" cols="30" rows="3"></textarea>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1"></div>
                                    <button class="btn btn-icon btn-rounded btn-primary mr-2"><i class="i-Paper-Plane"></i></button>
                                    <button class="btn btn-icon btn-rounded btn-outline-primary" type="button"><i class="i-Add-File"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- end of main-content -->
            </div>
			<?php include 'include/footer.php'; ?>