<div class="fixed-sidebar-right">
	<ul class="right-sidebar">
		<li>
			<div  class="tab-struct custom-tab-1">
				<ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
					<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="chat_tab_btn" href="#chat_tab">UI</a></li>
					<li role="presentation" class=""><a  data-toggle="tab" id="messages_tab_btn" role="tab" href="#messages_tab" aria-expanded="false">messages</a></li>
					<li role="presentation" class=""><a  data-toggle="tab" id="todo_tab_btn" role="tab" href="#todo_tab" aria-expanded="false">App Look</a></li>
				</ul>
				<div class="tab-content" id="right_sidebar_content">
					<div  id="chat_tab" class="tab-pane fade active in" role="tabpanel">
						<div class="chat-cmplt-wrap">
							<div class="chat-box-wrap">
								<div class="add-friend">
									<!-- <a href="javascript:void(0)" class="inline-block txt-grey">
										<i class="zmdi zmdi-more"></i>
									</a>	
									<span class="inline-block txt-dark">users</span>
									<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
									<div class="clearfix"></div> -->
								</div>								
								<div id="chat_list_scroll">
									<div class="nicescroll-bar">
										<ul class="chat-list-wrap">											
											<li class="chat-list">
												<div class="chat-body">
													<a  href="javascript:void(0)">
														<div class="chat-data">
															df
															<div class="clearfix"></div>
														</div>
													</a>													
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="recent-chat-box-wrap">
								<div class="recent-chat-wrap">
									<div class="panel-heading ma-0">
										<div class="goto-back">
											<a  id="goto_back" href="javascript:void(0)" class="inline-block txt-grey">
												<i class="zmdi zmdi-chevron-left"></i>
											</a>	
											<span class="inline-block txt-dark">ryan</span>
											<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="chat-content">
												<ul class="nicescroll-bar pt-20">
													<li class="friend">
														<div class="friend-msg-wrap">
															<img class="user-img img-circle block pull-left"  src="dist/img/user.png" alt="user"/>
															<div class="msg pull-left">
																<p>Hello Jason, how are you, it's been a long time since we last met?</p>
																<div class="msg-per-detail text-right">
																	<span class="msg-time txt-grey">2:30 PM</span>
																</div>
															</div>
															<div class="clearfix"></div>
														</div>	
													</li>
													<li class="self mb-10">
														<div class="self-msg-wrap">
															<div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
																<div class="msg-per-detail text-right">
																	<span class="msg-time txt-grey">2:31 pm</span>
																</div>
															</div>
															<div class="clearfix"></div>
														</div>	
													</li>
													<li class="self">
														<div class="self-msg-wrap">
															<div class="msg block pull-right">  How about you?
																<div class="msg-per-detail text-right">
																	<span class="msg-time txt-grey">2:31 pm</span>
																</div>
															</div>
															<div class="clearfix"></div>
														</div>	
													</li>
													<li class="friend">
														<div class="friend-msg-wrap">
															<img class="user-img img-circle block pull-left"  src="dist/img/user.png" alt="user"/>
															<div class="msg pull-left"> 
																<p>Not too bad.</p>
																<div class="msg-per-detail  text-right">
																	<span class="msg-time txt-grey">2:35 pm</span>
																</div>
															</div>
															<div class="clearfix"></div>
														</div>	
													</li>
												</ul>
											</div>
											<div class="input-group">
												<input type="text" id="input_msg_send" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
												<div class="input-group-btn emojis">
													<div class="dropup">
														<button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
														<ul class="dropdown-menu dropdown-menu-right">
															<li><a href="javascript:void(0)">Action</a></li>
															<li><a href="javascript:void(0)">Another action</a></li>
															<li class="divider"></li>
															<li><a href="javascript:void(0)">Separated link</a></li>
														</ul>
													</div>
												</div>
												<div class="input-group-btn attachment">
													<div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
														<input type="file" class="upload">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						
					<div id="messages_tab" class="tab-pane fade" role="tabpanel">
						<div class="message-box-wrap">
							<div class="msg-search">
								<a href="javascript:void(0)" class="inline-block txt-grey">
									<i class="zmdi zmdi-more"></i>
								</a>	
								<span class="inline-block txt-dark">messages</span>
								<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-search"></i></a>
								<div class="clearfix"></div>
							</div>
							<div class="set-height-wrap">
								<div class="streamline message-box nicescroll-bar">
									<a href="javascript:void(0)">
										<div class="sl-item unread-message">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Clay Masse</span>
												<span class="inline-block font-11  pull-right message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject">Themeforest message sent via your envato market profile</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsu messm quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)">
										<div class="sl-item">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user1.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Evie Ono</span>
												<span class="inline-block font-11  pull-right message-time">1 Feb</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject">Pogody theme support</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)">
										<div class="sl-item">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user2.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Madalyn Rascon</span>
												<span class="inline-block font-11  pull-right message-time">31 Jan</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject">Congratulations from design nominees</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)">
										<div class="sl-item unread-message">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user3.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Ezequiel Merideth</span>
												<span class="inline-block font-11  pull-right message-time">29 Jan</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject">Themeforest item support message</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)">
										<div class="sl-item unread-message">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user4.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Jonnie Metoyer</span>
												<span class="inline-block font-11  pull-right message-time">27 Jan</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject">Help with beavis contact form</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)">
										<div class="sl-item">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Priscila Shy</span>
												<span class="inline-block font-11  pull-right message-time">19 Jan</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject">Your uploaded theme is been selected</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
									<a href="javascript:void(0)">
										<div class="sl-item">
											<div class="sl-avatar avatar avatar-sm avatar-circle">
												<img class="img-responsive img-circle" src="dist/img/user1.png" alt="avatar"/>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font   pull-left message-per">Linda Stack</span>
												<span class="inline-block font-11  pull-right message-time">13 Jan</span>
												<div class="clearfix"></div>
												<span class=" truncate message-subject"> A new rating has been received</span>
												<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div  id="todo_tab" class="tab-pane fade" role="tabpanel">
						<div class="todo-box-wrap">
							<!-- <div class="add-todo">
								<a href="javascript:void(0)" class="inline-block txt-grey">
									<i class="zmdi zmdi-more"></i>
								</a>	
								<span class="inline-block txt-dark">App Look</span>
								<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
								<div class="clearfix"></div>
							</div> -->
							<div class="set-height-wrap">
								<!-- Todo-List -->
								<ul class="todo-list nicescroll-bar">
									<li class="todo-item">
										<div class="form-group">
											<label class="control-label mb-10" for="sku">Theme</label>	
											<select id= "theme_chooser" class="form-control theme_chooser" data-pattern="^theme-">
												<?php
													foreach($themes as $k=>$v){
														$selected = ($current_theme == $k)?"selected=\"selected\"":"";
														echo "<option value=\"{$k}\" $selected>$v</option>";
													}
												?>
											</select>
										</div>
									</li>
									<li class="todo-item">
										<div class="form-group">
											<label class="control-label mb-10" for="sku">Color Scheme</label>	
											<select id= "color_chooser" class="form-control theme_chooser" data-pattern="^pimary-color-">
												<?php
													foreach($theme_primary_colors as $k=>$v){
														$selected = ($current_theme_primary_color == $k)?"selected=\"selected\"":"";
														echo "<option value=\"{$k}\" $selected>$v</option>";
													}
												?>
											</select>
										</div>
									</li>									
								</ul>
								<!-- /Todo-List -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
	</ul>
</div>
