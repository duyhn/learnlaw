<?php
 class UserHelper extends HtmlHelper{
 //chua cac ham hien html them, sua, xoa cua he thong
 	
 function register(){
 		$namebutton="'submitdk'";
 		$register="<form action='/luatvnam/users/register' method='POST' id='registration_form'>";
 		$register.="<div class='formcon'><div class='label'>Họ tên </div>";
 		$register.="<div class='input'><input type='text' name='hoten' id='register_name' /></div></div>";
 		$register.="<div class='formcon'><div class='label'>Tên đăng nhập</div>";
 		$register.='<div class="input"><input type="text" name="username" id="register_uername" onchange="checkUser(this,'.$namebutton.')"/><div id="err"></div>';
 		$register.="<span class='left clear note'>Tên này sẽ dùng để đăng nhập trên Diễn đàn Pháp luật Việt Nam.</span></div></div>";
 		$register.="<div class='formcon'><div class='label'>Email</div>";
 		$register.="<div class='input'><input type='text' name='email' id='register_email' /><span class='left clear note'>Xin hãy nhập đúng địa chỉ email của bạn.</span></div></div>";
 		$register.="<div class='formcon'><div class='label'>Mật khẩu</div>";
 		$register.='<div class="input"><input type="password" name="password" id="register_password" onchange="comfimpass('.$namebutton.');" /></div></div>';
 		$register.="<div class='formcon'><div class='label'>Xác nhận mật khẩu</div>";
 		$register.='<div class="input"><input type="password" name="register_password_confirmation" id="register_password_confirmation" onchange="comfimpass('.$namebutton.');" /><div id="errpass"></div><span class="left clear note">Xin chọn mật mã cho hồ sơ của bạn. Chú ý: mật mã phải lớn hơn 6 kí tự".</span></div></div>';
 		$register.=" <div class='rules'>
					
						<div class='label titlerule font_title'>
							Nội quy
						</div>
						<div class='label1 clear' style='margin-left: 15px;'>
							Bạn cần đọc và chấp nhận đồng ý theo Điều Khoản Đăng Ký
						</div>
						<div class='left scrolldiv'>
							<p>
<span class='titleRules'>Quy định chung</span></br>
	-Thành viên không được phép dùng những tên truy cập thô tục, quá khích. Không chọn tên trùng hoặc gần giống với tên danh nhân, người nổi tiếng.
    -Tên truy cập/tên riêng của thành viên ban quản trị, cán bộ nhân viên, tên các đơn vị thành viên ĐH Công nghệ Thông tin, mã số sinh viên là các username được dành riêng, những thành viên đã chọn trùng username với username dành riêng sẽ được đổi username.</br>
    -Trao đổi một cách lành mạnh, có văn hoá, lịch sự, hoà nhã. Không chỉ trích gây hiềm khích, hạ nhục nhân phẩm thành viên khác vì bất cứ lý do gì.</br>
    -Diễn đàn chủ trương giữ gìn sự trong sáng của Tiếng Việt, tất cả các bài viết trên diễn đàn phải viết bằng Tiếng Việt có dấu, cố gắng viết đúng chính tả. Những bài viết quá lạm dụng ngôn ngữ mạng hay trình bày gây phản cảm sẽ bị sửa, xóa và cảnh cáo, tái phạm có thể bị ban.</br>
    -Diễn đàn cho phép sử dụng ngoại ngữ, nhưng vẫn phải đảm bảo đúng chính tả, ngữ pháp để thể hiện sự tôn trọng với ngôn ngữ bản xứ. Không được sử dụng các công cụ máy tính như EV-Trans, Google translate, v.v... để xây dựng nội dung bài viết ngoại ngữ.</br>
    -Không đăng tải những nội dung đi ngược lại truyền thống văn hoá nước nhà hoặc không được pháp luật của nước CHXHCN Việt Nam cho phép lưu hành.</br>
    -Mỗi thành viên tự chịu trách nhiệm với bài viết, các nội dung file đã đưa lên diễn đàn. Thành viên đăng sách vở hoặc bài viết không phải do chính mình viết thì cần ghi rõ ràng nguồn gốc.</br>
    -Không spam! Các hình thức sau đây được xem là spam:</br>
        +Đăng thông tin không có giá trị thảo luận vì không liên quan đến topic.</br>
        +Đăng quá nhiều tin nhỏ trong thời gian ngắn. Bạn phải sử dụng chức năng multi-quote khi trả lời nhiều người, phải edit bài cũ nếu muốn bổ sung thông tin mới.</br>
        +Dẫn link đến các trang web khác (kể cả video/nhạc) mà không có chú thích về nội dung link</br>
        +Dẫn các link không liên quan đến nội dung bài viết.</br>
    -Toàn bộ spam sẽ bị xóa ngay lập tức, thành viên vi phạm có thể bị cấm.</br>
    -Thành viên không được đăng thông tin có nội dung quảng cáo nếu không được người quản trị cho phép. BQT và admin là người quyết định cuối cùng. Các bài viết và thành viên vi phạm nội dung này có thể bị xóa mà không phải báo trước.</br>
    -Thành viên không được phép sử dụng những hình ảnh sau đây để làm ảnh đại diện :</br>
        +Các hình ảnh được bảo vệ bởi luật sở hữu trí tuệ mà thành viên không có quyền sử dụng.</br>
        +Những hình ảnh ngụ ý kích động, gây chia rẽ, hiềm khích.</br>
        +Những hình ảnh lố lăng hay có tính cách khiêu dâm đồi trụy</br>
        +Các hình ảnh có ngụ ý chửi bới bất cứ điều gì với bất cứ lý do gì.</br>
        +Các hình ảnh các danh nhân, lãnh tụ của các quốc gia trong cả hiện tại và quá khứ.</br>
        +Các biểu tượng tôn giáo, tín ngưỡng.</br>
    -Không chấp nhận các hình thức downline, captcha, kiếm tiền qua mạng bằng phương thức click quảng cáo, quảng cáo cho bất cứ phương thức kinh doanh lừa đảo nào (như bán hàng đa cấp dưới hình thức đóng tiền mua trước sản phẩm, hoặc đóng tiền để được huấn luyện, đóng tiền bảo đảm...).</br>
    -Ban quản trị có quyền xem xét và quyết định bài viết nào là vi phạm. Nếu bạn có thắc mắc, vui lòng điền đúng vào mẫu và gửi ở mục Thắc mắc góp ý.</br>

    -Góc học hập chỉ để chia sẻ kiến thức. Các thảo luận về lịc học, điểm thi, phòng học, v.v... post trong box Cộng đồng UIT</br>
    -Không nhờ vả xin xỏ người khác làm bài tập hộ. Các thảo luận về bài tập không nhằm tìm hiểu kiến thức mà chỉ chú trọng vào việc lấy được bài giải sẽ bị khóa.</br>
<span style='font:bold 14px Arial'>Các điều khoản trong Nội qui có thể thay đổi bất cứ lúc nào (sẽ có thông báo ngay khi đổi) nên để tránh mọi thắc mắc về việc bài bị xóa hay nick bị ban, đề nghị mỗi thành viên nên thường xuyên đọc kỹ nội qui này.
</span>				
						</div>	

						<div class='left'>					
							<div class='left'>
								<input TYPE='checkbox' onclick='ennablebutton()'  id='isagree' name='isagree' VALUE='label1'
									required='true' />
							</div>
							<div class='label1' style='margin-left: 3px;'>
								Tôi đồng ý
							</div>
						</div>
                	</div>	
 		";
 		$register.="<div class='left clear disbutton'><input type='submit' id='submitdk'  class='buttonre' disabled=true value='Đăng ký' name='ok'/>
 		<input type='reset' id=''  class='buttonre' value='Nhập lại' name='reset'/>
 		</div>";
 		$register.="</form>";
 		return $register;
 	}
 	//phan trang
 	public function pagination($controller,$action,$idtype=null,$type=null,$page,$pagebgin,$pageend,$numberrecord){
 		
 		$pagin="";
 		if($page!=1){
 			$pagin.=$this->link('Trước',array('controller' => $controller,'action' => $action,'full_base' => true,$idtype,$type,($page>1?$page-1:1),$pageend),array('class'=>'button' ));
 		}
 		if($pagebgin>1)
 			 $pagin.="...";
 		for($i=$pagebgin;$i<=$pageend;$i++){
 			$class="";
 			if($page==$i){
 				$class="curent";
 			}
 			$pagin.=$this->link($i,array('controller' => $controller,'action' => $action,'full_base' => true,$idtype,$type,$i,$pageend),array('class'=>$class));
 		}
 		if($pageend<$numberrecord)
 			$pagin.= "...";
 		if($page!=$pageend)
 			$pagin.=$this->link('Sau',array('controller' => $controller,'action' =>  $action,'full_base' => true,$idtype,$type,($page<$numberrecord?$page+1:$numberrecord),$pageend),array('class'=>'button' ));
 		return $pagin;
 	}
	//menu tren
	function create_adminmenu($username){
		$menu="<ul class='nav'><li class='trangchu'>".$this->link('Trang chủ',array('controller' => 'admin','action' => '','full_base' => true)
		)."</li><li>";
		$menu.=$this->link('Quản lý người dùng',array('controller' => 'admin','action' => 'managedUser'));
		$menu.="<li>".$this->link('Quản lý tài liệu',array('controller' => 'admin','action' => 'manageUpload','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý thi',array('controller' => 'admin','action' => 'manageTest','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý câu hỏi',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý tư vấn',array('controller' => 'admin','action' => 'manageConsulting','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý thông báo',array('controller' => 'admin','action' => 'manageNews','full_base' => true))."</li>";

		$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li>";
		$menu.="<li style='float:right'><a>Xin chào: ".$username." </a></li> </ul>";
 		return $menu;
	}
 /*Menu admin*/
 	function menudoc(){
 		$doc= $this->script(array('jquery-1.7.2.min.js','menu_jquery.js'));
		$doc.="<div id='cssmenu'>
				<ul>
				   <li class='active'><a href='index.html'><span>Trang chủ</span></a></li>
					<li>".$this->link('Thành viên',array('controller' => 'admin','action' => 'managedUser','full_base' => true))."</a></li>
				   <li>".$this->link('Tài liệu',array('controller' => 'admin','action' => 'manageUpload','full_base' => true))."</a></li>
					<li>".$this->link('Thông báo',array('controller' => 'admin','action' => 'manageInfo','full_base' => true))."</a></li>
				    <li>".$this->link('Tin tức',array('controller' => 'admin','action' => 'manageNews','full_base' => true))."</a></li>
					<li class='has-sub'><a href='#'><span>Thi trực tuyến</span></a>
				    	<ul>
				  			<li>".$this->link('Lĩnh vực câu hỏi',array('controller' => 'admin','action' => 'manageTest','full_base' => true))."</a></li>
				           	<li>".$this->link('Ngân hàng câu hỏi',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</a></li>
				           	<li>".$this->link('Kết quả thi',array('controller' => '','action' => '','full_base' => true))."</li>
				   		</ul>
				   	</li>
				   	<li  class='has-sub'><a href='#'><span>Tư vấn</span></a>
				       <ul>
				           	<li>".$this->link('Câu hỏi đã trả lời',array('controller' => 'admin','action' => 'manageConsulted','full_base' => true))."</a></li>
				           	<li>".$this->link('Câu hỏi chưa trả lời',array('controller' => 'admin','action' => 'manageConsulting','full_base' => true))."</a></li>
				        </ul>
				     </li>				  
				    <li class='has-sub'>".$this->link('Diễn đàn',array('controller' => 'admin','action' => 'manageForum','full_base' => true))."</a>
				     	<ul>
				  			<li>".$this->link('Diễn đàn con',array('controller' => 'admin','action' => 'manageForum','full_base' => true))."</a></li>
				           	<li>".$this->link('Chủ đề',array('controller' => 'admin','action' => 'manageToppic','full_base' => true))."</a></li>
				           	<li>".$this->link('Bình luận',array('controller' => 'admin','action' => 'manageComment','full_base' => true))."</li>
				   		</ul>
				   	</li>
				</ul>
				</div>";
		return $doc;
	}
	/*Menu user 17-5-2014*/
 	function menudocUser(){
		$doc= $this->script(array('jquery-1.7.2.min.js','menu_jquery.js'));
		$doc.="<div id='cssmenu'>
				<ul>
				   <li><a href='index.html'><span>Home</span></a></li>
				   <li class='has-sub'><a href='#'><span>Thông tin của bạn</span></a>
				      <ul>				      	
				         <li><a onclick='changepass()'>Sửa mật khẩu</a></li>
				         
				      </ul>
				   </li>
				   <li class='has-sub'>".$this->link('Chủ đề của bạn',array('controller' => 'Users','action' => 'createTopic','full_base' => true))."
				    	<ul>
				  			<li>".$this->link('Tạo chủ đề',array('controller' => 'Users','action' => 'managerTopic','full_base' => true))."</li>
				        
				   		</ul>
				   </li>
				   
				</ul>
				</div>";
		return $doc;
	}
	
	/*User
	 * */
	//them, sua user 
	function create_formManageUser($role,$user,$user_id=null){
		$name="";
		$email="";
		$roleid=0;
		$usname="";
		$action="/luatvnam/admin/admin/createuser";
		$status="";
		if(isset($user) && $user!=null){
			$name=$user['User']['hoten'];
			$email=$user['User']['email'];
			$roleid=$user['User']['idRole'];
			$usname=$user['User']['username'];
			$action="/luatvnam/admin/admin/updateusser";
			if($user['User']['status']==1){
				$status="checked";
			}
		}
		$namebutton="'btnUsermn'";
		$register="<table><form action='".$action."' method='POST' id='registration_form' name='User'>";
		$register.="<tr><td><label for='register_name'>Họ tên</label></td>";
		$register.="<td><input type='text' name='hoten' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Tên đăng nhập</label></td>";
		$register.='<td><input type="text" name="username" value="'.$usname.'" id="register_uername" onchange="checkUser(this,'.$namebutton.')"/></td>';
		$register.="<tr><td></td><td><div id='err'></div></td></tr>";
		$register.="<tr><Td><label for='register_email'>Email</label></td>";
		$register.="<td><input type='text' name='email' value='".$email."' id='register_email' /></td></tr>";
		$register.="<tr><td><label for='register_role'>Quyền</label></td>";
		$register.="<td><select name='idRole'>";
		foreach ($role as $item){
			$selected="";
			if($item['Role']['idRole']==$roleid){
				$selected="selected";
			}
			$register.="<option value=".$item['Role']['idRole']." ".$selected.">".$item['Role']['rolename']."</option>";
		}
		$register.="</select><td>";
		$register.="<tr><td><label for='register_active'>Trạng thái</label></td>";
		$register.="<td><input type='checkbox' name='status' value='1' id='register_active' ".$status." /></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
						<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
						<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
					</div></form>";
		return $register;
	}
//hien thi list nguoi dung
	function create_listUer($data){
		
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<th class='tdstt'>STT</th>
					<th >Chọn</th>
					<th>Họ và tên</th>
					<th>Tên đăng nhập</th>
					<th>Email</th>
					<th>Trạng thái</th>
					<th>Ngày đăng ký</th>
					<th>Ngày chỉnh sửa</th>
					<th>Quyền</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		$message="'Bạn có muốn xóa?Y/N'";
		$model="'User'";
		foreach ($data as $item){
			$class="even";
			if(($i%2)!=0){
				$class="odd";
			}
			$register.="<tr id='trupload' class=". $class ."><td class='stt'>".$i."</td><td><input type='checkbox' name='chon[]' value='".$item['User']['user_id']."' /></td><td>".$item['User']['hoten']."</td><td>".$item['User']['username']."</td><td>";
			$register.=$item['User']['email']."</td>";
			$status=$item['User']['status'];
			if($status==1)$register.="<td>Đang hoạt động</td>";
			else $register.="<td>Tạm ngưng hoạt động</td>";
			$register.="<td>".$this->inngay($item['User']['created'])."</td>";		
			$register.="<td>".$this->inngay($item['User']['modified'])."</td>";	
			$register.="<td>".$item['Role']['rolename']."</td>";	
			$register.="<td>".$this->link('',array('controller' => 'admin','action' => 'formUpdateUser','full_base' => true,$item['User']['user_id']),array('class'=>'icedit','title'=>'sửa'));
			$register.='<form  method="post" action="/luatvnam/admin/admin/deleUser/'.$item['User']['user_id'].'" >
					<input id="" alt="" value="" class="icdelete" title="xóa" type="image" onclick="return confirm('.$message.');" /></form></td></tr>';
				
			//$register.=$this->link('',array('controller' => 'admin','action' => 'deleUser','full_base' => true,$item['User']['user_id']),array('class'=>'icdelete','title'=>'xóa'))."</td></tr>";
			$i++;
		}
		$register.='<tr><td colspan=3><input type="button" class="button2 sizebutton2" value="Xóa nhiều" onclick="deleteMulti('.$model.')" /></td></tr>';
		$register.="</tbody></table>
		<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'managedUser','full_base' => true));
	
		return $register;
	}
//hien thi list cau hoi thi online
	function create_listQuestion($data,$page=null,$end=null){
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th>
					<th >Chọn</th>
					<th>Câu hỏi</th>
					<th class='sizeAction'>Tác vụ</th></tr>
					</thead><tbody>";
		$i=1;
		$message="'Bạn có muốn xóa?Y/N'";
		$model="'Question'";
		foreach ($data as $item){
		$class="even";
		if(($i%2)!=0){
			$class="odd";
		}
			$register.="<tr id='trupload' class=". $class ."><td>".$i."</td><td><input type='checkbox' name='chon[]' value='".$item['Question']['id']."' /></td><td>".$item['Question']['title']."</td>";
			$register.="<td class='sizeAction'>";
			$register.=$this->link(' ',array('controller' => 'admin','action' => 'editQuestion','full_base' => true,$item['Question']['id'],$page,$end),array('class'=>'icedit','title'=>'sửa'));
			$idtype=$item['Question']['id_type'];
			$id=$item['Question']['id'];
// 			$register.="<form  method='post'
// 									action='/vnbus/agency/buses/${bus.id}'>". $this->link(' ',array('controller' => 'admin','action' => 'deleteQuestion','full_base' => true,$item['Question']['id_type'],$item['Question']['id'],$page,$end),array('class'=>'icdelete','title'=>'xóa'))."</td></tr>";
			$register.='<form  method="post" action="/luatvnam/admin/admin/deleteQuestion/'.$idtype.'/'.$id.'/'.$page.'/'.$end.'" >
					<input id="" alt="" value="" class="icdelete" title="xóa" type="image" onclick="return confirm('.$message.');" /></form></td></tr>';
			$i++;
		}
		$register.='</td></tr><tr><td><input type="button" class="button2 sizebutton2" value="Xóa nhiều" onclick="deleteMulti('.$model.')" /></td></tr></tbody></table>';
		$register.="<div class='left cach'><span class='icadd'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</div>";
			
		return $register;
	}
// them,sua cau hoi thi truc tuyen
	function create_formManageQuestion($type,$question,$method,$idtype=null,$page=null,$end=null){
		$tile="";
		$idqs=0;
		$action="/luatvnam/admin/admin/createQuestion";
		if(isset($question) && $question!=null){
			$tile=$question['Question']['title'];
			$idqs=$question['Question']['id'];
			$action="/luatvnam/admin/admin/updateQuestion/".$question['Question']['id'];
		}
		$register="<form action='".$action."' method='POST' id='formQuestion' name='Question'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Thể loại</label></td>";
		$register.="<td><select name='id_type' id='idtype' onchange='changeidtypeQuestion()'>";
		foreach ($type as $item){
			$selected="";
			if($item['Typequestion']['id']==$idtype){
				$selected="selected";
			}
			$register.="<option value=".$item['Typequestion']['id']." " . $selected.">".$item['Typequestion']['title']."</option>";
		}
		
		$register.="</select><td></tr>";
		if(isset($page) || isset($end)){
			$register.="<input type='hidden' name='page'  value='".$page."' />";
			$register.="<input type='hidden' name='end'  value='".$end."' />";
		}
		$register.="<tr><td><label for='register_name'>Nội dung câu hỏi</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='title' id='title' >".$tile."</textarea><td></tr>";
		$register.="<input type='hidden' name='idqs' id='idqs'  value='".$idqs."' />";
		if($method!=null && isset($method)){
			$register.="<tr><td><label>Các Phương án trả lời</label></td><tr>";
			$i=1;
			foreach ($method as $item){
				$register.="<tr><td><label>Phương án ".$i.": ".$this->link('Xóa',array('controller' => 'admin','action' => 'deleteMethod','full_base' => true,$item['Method']['id'],$question['Question']['id'],$page,$end))."</label></td></tr>";
				$i++;
				$register.="<input type=hidden name='idmethod[]' value=".$item['Method']['id'].">";
				$register.="<tr><td><label for='register_name'>Nội dung câu trả lời</label></td>";
				$register.="<td><textarea rows='4' cols='50' name='content[]' >".$item['Method']['content']."</textarea><td></tr>";
				$register.="<tr><td><label for='register_name'>Đúng/sai:</label></td><td><select name='corect[]'>";
				$selected0="";
				$selected1="";
				if($item['Method']['corect']==0){
					$selected0="selected";
				}
				if($item['Method']['corect']==1){
					$selected1="selected";
				}
				$register.="<option value=0 ".$selected0.">sai</option>";
				$register.="<option value=1 ".$selected1.">Đúng</option>";
			}
			$register.="</select><td></tr></table>";
		}
		$register.="<table ><tr><td><label><a onclick='addmethod()'><span class='icadd'></span>Thêm phương án trả lời</a></label></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='btnDatcauhoi' type='submit' value='Lưu' name='ok' onclick='return checkpa();'/>
						<input class='button2' id='' type='reset' value='Nhập lại' onclick='search()'/>
					</div>
					</form>";
		return $register;
	}

	////nguoi dung đat cau hoi tu van
	function create_formConsultings($typeConsultings=null,$idTypeconsulting=null,$page=null,$end=null){
		$tile="";

		$action="/luatvnam/Tuvan/createConsultings/".$page."/".$end;
		$register="<form action='".$action."' method='POST' id='Consulting' name='Consulting'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Thể loại</label></td>";
		$register.="<td><select name='typeconsulting_id' id='typeconsulting_id' onchange='changeidTypeConsultings()'>";
		foreach ($typeConsultings as $item){
			$selected="";
			if($item['Typeconsulting']['id']==$idTypeconsulting){
				$selected="selected";
			}
			$register.="<option value=".$item['Typeconsulting']['id']." " . $selected.">".$item['Typeconsulting']['name']."</option>";
		}
		$register.="</select><td></tr>";
		$register.="<tr><td><label for='register_name'>Họ tên</label></td>";
		$register.="<td><input type='text' name='name' id='hotentuvan' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Email</label></td>";
		$register.="<td><input type='text' name='email' id='emailtuvan' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Tiêu đề</label></td>";
		$register.="<td><input type='text' name='title' id='titletuvan' /><td></tr>";

		$register.="<tr><td><label for='register_name'>Nội dung câu hỏi</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='contents' id='contenttuvan'></textarea><td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbt' style='margin-left:250px;'>
						<input class='button2 sizebutton2' id='subDatcauhoituvan' type='submit' value='Lưu' name='ok'/>
						<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
					</div>
					</form>";
		return $register;
	}
	//hien thi danh sach cau hoi tu van cho user
	function create_listConsultings($data=null){
		$register="<p>Không tìm thấy danh sách câu hỏi</p>";
		
		if(isset($data)&&count($data)>0){
			$register="";
			foreach ($data as $item){
				$register.="<div class='consulting'><h4>".$this->link($item['Consulting']['title'],array('controller' => 'Tuvan','action' => 'detail','full_base' => true,$item['Consulting']['id']))."</h4>";
				$register.="<p>".$this->noidungtt(30,$item['Consulting']['contents'])."</p>";
				//chuyen doi ngay				
				 $date = $item['Consulting']['consulting_date'];
				 $d = getdate(strtotime($date));
				$inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'] .' '. $d['hours'].':'.$d['minutes'].':' .$d['seconds'];
		//		$indate=date('d/m/Y H:i:s', $date);
				$register.="<i>".$inngay."</i></div>";
			}
		}
		return $register;
	}
	//tra loi, xoa cau hoi tu van
	function create_formAdminConsultings($typeConsultings=null,$idTypeconsulting=null,$conlusting=null,$actiont){
		$tile="";
		$idcons=0;
		$conttent="";
		$result="";
		
		$action="/luatvnam/admin/admin/createResultconsultings/".$actiont;
		if(isset($conlusting) && $conlusting!=null){
		
			$tile=$conlusting['Consulting']['title'];
			$idcons=$conlusting['Consulting']['id'];
			$conttent=$conlusting['Consulting']['contents'];
			
			if(count($conlusting['Resultconsulting'])>0 && $conlusting['Resultconsulting']!=null){
				$result=$conlusting['Resultconsulting'][0]['contents'];
				$action="/luatvnam/admin/admin/updateConsulted/".$actiont;
			}
		
		}
		
		$register="<form action='".$action."' method='POST' id='Resultconsulting' name='Resultconsulting'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Thể loại</label></td>";
		$register.="<td><select name='typeconsulting_id' id='typeconsulting_id' class='sizeinput' onchange='changeidTypeConsultings()'>";
		foreach ($typeConsultings as $item){
			$selected="";
			if($item['Typeconsulting']['id']==$idTypeconsulting){
				$selected="selected";
			}
			$register.="<option value=".$item['Typeconsulting']['id']." " . $selected.">".$item['Typeconsulting']['name']."</option>";
		}
		$register.="</select><td></tr>";
		$register.="<tr><td><label for='register_name'>Tiêu đề</label></td>";
		$register.="<td><input type='text' name='title' id='register_title' value='".$tile."'/>";
				
		$register.="<input type='hidden' name='consulting_id'  value='".$idcons."' id='' /><td></tr>";
		
		
		$register.="<tr><td><label for='register_name'>Nội dung câu hỏi</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='concontents' id='concontents' >".$conttent."</textarea><td></tr>";
		$register.="<tr><td><label for='register_name'>Nội dung câu trả lời</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='contents' id='contents' >".$result."</textarea><td></tr>";
		$register.="<script type='text/javascript'>CKEDITOR.replace(contents); </script>";
		$register.="<tr><td></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='btnTuvan' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='reset' value='Nhập lại' name='search'/>
					</div></form>";
		return $register;
	}
	//xem danh sách tu van ben admin
	function create_listConsulting($data,$action1,$action2,$page=null,$end=null){//bolean=0 or 1
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th>
					<th>Chọn</th>
					<th>Tiêu đề</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		//$data=$typeNews['Tbltintuc'];
		$message="'Bạn có muốn xóa?Y/N'";
		$model="'Consulting'";
		foreach ($data as $item){
			$idtype=$item['Consulting']['typeconsulting_id'];
			$id=$item['Consulting']['id'];
			$register.="<tr><td>".$i."</td><td><input type='checkbox' name='chon[]' value='".$item['Consulting']['id']."' /></td><td>".$item['Consulting']['title']."</td>";
			$register.="<td class='sizeAction'>";
			$register.=$this->link('',array('controller' => 'admin','action' => $action2,'full_base' => true,$item['Consulting']['id'],$action1,$page,$end),array('class'=>'icedit','title'=>'sửa'));
			//$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleteNews','full_base' => true,$item['Consulting']['id'],$page,$end))."</td></tr></td></tr>";
			$register.='<form  method="post" action="/luatvnam/admin/admin/deleteConsulting/'.$id.'/'.$page.'/'.$end.'" >
					<input type="hidden" name="view" value="'.$action1.'"/>
					<input id="" alt="" value="" class="icdelete" title="xóa" type="image" onclick="return confirm('.$message.');" /></form></td></tr>';
			$i++;
		}
		$register.='</td></tr><tr><td><input type="button" class="button2 sizebutton2" value="Xóa nhiều" onclick="deleteMulti('.$model.')" /></td></tr></tbody></table>';
		$register.="</tbody></table>";
		$register.="<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => $action1,'full_base' => true));
			
		return $register;
	}
	/* Tin tuc
	 * */
	public function create_FormNews($News=null,$idtypeNews=null,$ListtypeNew=null,$page=null,$end=null){
		$tile="";
		$idnews=0;
		$noidung="";
		$action="/luatvnam/admin/admin/createNews";
		$check="";
		//neu co bien news la sua
		if(isset($News) && $News!=null){
			$tile=$News['Tbltintuc']['tieude'];
			$idnews=$News['Tbltintuc']['id_tintuc'];
			$noidung=$News['Tbltintuc']['noidung'];
			$action="/luatvnam/admin/admin/updateNews";
			if($News['Tbltintuc']['hien_an']==1){
				$check="checked";
			}
		}

		$register="<form action='".$action."' method='POST' id='news' name='News'  enctype='multipart/form-data'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Thể loại</label></td>";
		if(isset($page) || isset($end)){
			$register.="<input type='hidden' name='page'  value='".$page."' />";
			$register.="<input type='hidden' name='end'  value='".$end."' />";
		}
		$register.="<td><select name='id_theloai' id='id_theloai' onchange='changeidTypeNews()'>";
		
		foreach ($ListtypeNew as $item){
			$selected="";
			if($item['Tbltheloai']['id_theloai']==$idtypeNews){
				$selected="selected";
			}
			$register.="<option value=".$item['Tbltheloai']['id_theloai']." " . $selected.">".$item['Tbltheloai']['ten_theloai']."</option>";
		}
		$register.="</select><td></tr>";
		$register.="<tr><td><label for='register_name'>Tiêu đề</label></td>";
		$register.="<td><input type='text' name='tieude' id='tieude_news' value='".$tile."' /><td></tr>";
		$register.="<input type='hidden' name='id_tintuc'  value='".$idnews."' />";
		$register.="<tr><td><label for='register_name'>Nội dung</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='noidung' id='noidung_news' >".$noidung."</textarea><td></tr>";
		$register.="<tr><td><label for='register_name'>Ảnh đại diện</label></td>";
		$register.="<td><input  type='file' name='file' id='file' accept='image/*'/><td></tr>";
		$register.="<tr><td><label for='register_name'>Hiện ẩn</label></td>";
		$register.="<td><input  type='checkbox' name='hien_an' id='hien_an' value='1' ".$check." /><td></tr>";
		$register.="<script type='text/javascript'>CKEDITOR.replace( noidung); </script>";	
		
		
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='submit_news' type='submit' value='Lưu' name='ok'/>
						<input type='reset' id=''  class='button2 sizebutton2' value='Nhập lại' name='reset'/>
					</div></form>";
		return $register;
	}
	public function createListNews($typeNews=null,$page=null,$end=null){
		$register="<table cellspacing='0' class='clear sizeAd' > 
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th>
					<th class=''>Chọn</th>
					<th>Tin tức</th>
					<th>Duyệt</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		$message="'Bạn có muốn xóa?Y/N'";
		$model="'Tbltintuc'";
		//$data=$typeNews['Tbltintuc'];
		foreach ($typeNews as $item){
			$class="even";
			if(($i%2)!=0){
				$class="odd";
			}
			$register.="<tr id='trupload' class=". $class ."><td>".$i."</td><td><input type='checkbox' name='chon[]' value='".$item['Tbltintuc']['id_tintuc']."' /> </td><td>".$item['Tbltintuc']['tieude']."</td>";
// 			$register.="<td>".$this->link('Xem',array('controller' => '','action' => '','full_base' => true)).$this->link('Sửa',array('controller' => 'admin','action' => 'editNews','full_base' => true,$item['Tbltintuc']['id_tintuc'],$page,$end));
// 			$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleteNews','full_base' => true,$item['Tbltintuc']['id_tintuc'],$page,$end))."</td></tr>";
			$register.="<td><input type='checkbox' name='duyet[]' value='".$item['Tbltintuc']['id_tintuc']."' /></td>";
			$register.="<td class='sizeAction'>";
			$register.=$this->link('',array('controller' => 'admin','action' => 'editNews','full_base' => true,$item['Tbltintuc']['id_tintuc'],$page,$end),array('class'=>'icedit','title'=>'sửa'));
			//$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleteNews','full_base' => true,$item['Consulting']['id'],$page,$end))."</td></tr></td></tr>";
			$register.='<form  method="post" action="/luatvnam/admin/admin/deleteNews/'.$item['Tbltintuc']['id_tintuc'].'/'.$page.'/'.$end.'" >
					<input id="" alt="" value="" class="icdelete" title="xóa" type="image" onclick="return confirm('.$message.');" /></form></td></tr>';
			
			$i++;
		}
		$register.='<tr><td><input type="button" class="button2 sizebutton2" value="Xóa nhiều" onclick="deleteMulti('.$model.')" /></td></tr>';
		$register.="</tbody></table>";
		$register.="<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'admin_manageNews','full_base' => true));
			
		return $register;
	}
	///manager forum
	public function create_form_forum($forum=null,$page=null,$end=null){
		
		$title="";
		$idforum=0;
		$action="/luatvnam/admin/admin/createForum";
		$decription="";
		if(isset($forum)&& $forum!=null){
			$title=$forum['Forum']['name'];
			$idforum=$forum['Forum']['id'];
			$decription=$forum['Forum']['decription'];
			$action="/luatvnam/admin/admin/updateForum";
		}
		$register="<form action='".$action."' method='POST' id='forum' name='forum'>";
		if(isset($page) || isset($end)){
			$register.="<input type='hidden' name='page'  value='".$page."' />";
			$register.="<input type='hidden' name='end'  value='".$end."' />";
		}
		
		$register.="<table id='tbform'><tr><td><label for='register_name'>Tên diễn đàn</label></td>";
		$register.="<td><input type='text' name='name' id='name' value='".$title."'/></td></tr>";
		$register.="<input type='hidden' name='id'  value='".$idforum."' />";
		$register.="<tr><td><label for='register_name'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='decription' id='decription' >".$decription."</textarea></td></tr>";
		
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='btnForum' type='submit' value='Lưu' name='ok'/>
						<input class='button2' type='reset' value='Nhập lại' name='search'/>
						
					</div></form>";
		return $register;
	}
	//
	public function createListForums($forums=null,$page=null,$end=null){
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th>
					<th>Diễn đàn</th>
					<th>Mô tả</th>
					<th>Ngày tạo</th>
					<th>Ngày cập nhật</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		//$data=$typeNews['Tbltintuc'];
		foreach ($forums as $item){
			$register.="<tr><td class='stt'>".$i."</td><td>".$item['Forum']['name']."</td>";
			$register.="<td>".$item['Forum']['decription']."</td>"
						."<td class='colngay'>".$this->inngay($item['Forum']['created'])."</td>"	
						."<td class='colngay'>".$this->inngay($item['Forum']['modified'])."</td>"			
			;
			$register.="<td>".$this->link('',array('controller' => 'admin','action' => 'editForum','full_base' => true,$item['Forum']['id'],$page,$end),array('class'=>'icedit','title'=>'sửa'));
			$register.=$this->link('',array('controller' => 'admin','action' => 'deleteForum','full_base' => true,$item['Forum']['id'],$page,$end),array('class'=>'icdelete','title'=>'xóa'))."</td></tr></td></tr>";
			$i++;
		}
		$register.="</tbody></table>";
		$register.="<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'admin_manageForum','full_base' => true));
			
		return $register;
	}
 ///manager forum
	public function create_form_Topic($idforum=null,$forums=null,$Topic=null,$page=null,$end=null){
		
		$title="";
		$content="";
		$idTopic=0;
		
		$action="/luatvnam/admin/admin/createTopic";
		if(isset($Topic)&& $Topic!=null){
			$title=$Topic['Topic']['name'];
			$idTopic=$Topic['Topic']['id'];
			$content=$Topic['Topic']['content'];
			$action="/luatvnam/admin/admin/updateTopic";
		}
		$register="<form action='".$action."' method='POST' id='forum' name='forum'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Diễn đàn</label></td>";
		if(isset($page) || isset($end)){
			$register.="<input type='hidden' name='page'  value='".$page."' />";
			$register.="<input type='hidden' name='end'  value='".$end."' />";
		}
		$register.="<td><select name='forum_id' id='forum_id' onchange='changeidForum(this)'>";
		
		foreach ($forums as $item){
			$selected="";
			if($item['Forum']['id']==$idforum){
				$selected="selected";
			}
			$register.="<option value=".$item['Forum']['id']." " . $selected.">".$item['Forum']['name']."</option>";
		}
		$register.="</select><td></tr>";
		$register.="<tr><td><label for='register_name'>Tên chủ đề</label></td>";
		$register.="<td><input type='text' name='name' id='name' value='".$title."'/></td></tr>";
		$register.="<input type='hidden' name='id'  value='".$idTopic."' />";
		$register.="<tr><td><label for='register_name'>Nội dung</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='content' id='content' value='".$content."' ></textarea></td></tr>";
		
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='btnTopic' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='reset' value='Nhập lại' />
					</div></form>";
		return $register;
	}
	public function createListTopics($Topics=null,$page=null,$end=null){
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th>
					<th>Chủ đề</th>
					<th>Nội dung</th>
					<th>Ngày tạo</th>
					<th>Ngày cập nhật</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		//$data=$typeNews['Tbltintuc'];
		foreach ($Topics as $item){
			$register.="<tr><td>".$i."</td><td>".$item['Topic']['name']."</td>";
			$register.="<td>".$item['Topic']['content']."</td>"
						."<td class='colngay'>".$this->inngay($item['Topic']['created'])."</td>"	
						."<td class='colngay'>".$this->inngay($item['Topic']['modified'])."</td>"	;
			$register.="<td>".$this->link('',array('controller' => 'admin','action' => 'editTopic','full_base' => true,$item['Topic']['id'],$page,$end),array('class'=>'icedit','title'=>'sửa'));
			$register.=$this->link('',array('controller' => 'admin','action' => 'deleteTopic','full_base' => true,$item['Topic']['id'],$page,$end),array('class'=>'icdelete','title'=>'xóa'))."</td></tr></td></tr>";
			$i++;
		}
		$register.="</tbody></table>";
		$register.="<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'admin_manageNews','full_base' => true));
			
		return $register;
	}
	public function create_form_post($forums=null,$idforum=null,$Topics=null,$idtopic=null,$post=null,$page=null,$end=null){
		$title="";
		$content="";
		$idPost=0;
		
		$action="/luatvnam/admin/admin/createPost";
		if(isset($post)&& $post!=null){
			
			$idPost=$post['Post']['id'];
			$content=$post['Post']['content'];
			$action="/luatvnam/admin/admin/updatePost";
		}
		$register="<form action='".$action."' method='POST' id='forum' name='forum'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Diễn đàn</label></td>";
		$register.="<td><select name='forum_id' id='forum_id' onchange='changeForum()'>";
		foreach ($forums as $item){
			$selected="";
			if($item['Forum']['id']==$idforum){
				$selected="selected";
			}
			$register.="<option value=".$item['Forum']['id']." " . $selected.">".$item['Forum']['name']."</option>";
		}
		$register.="</select><td></tr>";
		$register.="<tr><td><label for='register_name'>Topic</label></td>";
		$register.="<td><select name='topic_id' id='topic_id' onchange='changeTopic()'>";
		foreach ($Topics as $item){
			$selected="";
			if($item['Topic']['id']==$idtopic){
				$selected="selected";
			}
			$register.="<option value=".$item['Topic']['id']." " . $selected.">".$item['Topic']['name']."</option>";
		}
		$register.="</select><td></tr>";
		
		if(isset($page) || isset($end)){
			$register.="<input type='hidden' name='page'  value='".$page."' />";
			$register.="<input type='hidden' name='end'  value='".$end."' />";
		}
		
		$register.="<input type='hidden' name='id' id='idpost'  value='".$idPost."' />";
		$register.="<tr><td><label for='register_name'>Bình luận</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='content' id='content'  >".$content."</textarea></td></tr>";
		
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='btnPost' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='reset' value='Nhập lại' name='search'/>
					</div></form>";
		return $register;
	}
	public function createListPosts($Posts=null,$page=null,$end=null){
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th>
					<th>Nội dung</th>
					<th>Người viết</th>
					<th>Ngày tạo</th>
					<th>Ngày cập nhật</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		//$data=$typeNews['Tbltintuc'];
		foreach ($Posts as $item){
			$register.="<tr><td>".$i."</td><td>".$item['Post']['content']."</td>";
			$register.="<td>".$item['User']['username']."</td>"
						."<td class='colngay'>".$this->inngay($item['Post']['created'])."</td>"	
						."<td class='colngay'>".$this->inngay($item['Post']['modified'])."</td>"	;
			$register.="<td>".$this->link('',array('controller' => 'admin','action' => 'editPost','full_base' => true,$item['Post']['id'],$page,$end),array('class'=>'icedit','title'=>'sửa'));
			$register.=$this->link('',array('controller' => 'admin','action' => 'deletePost','full_base' => true,$item['Post']['id'],$page,$end),array('class'=>'icdelete','title'=>'xóa'))."</td></tr></td></tr>";
			$i++;
		}
		$register.="</tbody></table>";
		$register.="<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'admin_manageNews','full_base' => true));
			
		return $register;
	}
	//ham lay noi dung tom tat
	function noidungtt($sotu,$noidung) {
		$noidung=trim($noidung);
		$n = explode(" ", $noidung);
		$noidunginra = " ";
		if ($sotu <= count($n)) {
			for ($i = 0; $i < $sotu; $i++){
				$noidunginra.= $n[$i] . " ";
			}
			$noidunginra.="...";
		}	
		return $noidunginra;
	}
	//function hien thi ngay
	function inngay($ngay) {
	$date = $ngay;//$data['Upload']['modified'];
	$d = getdate(strtotime($date));
	return $inngay = $d['mday'].'-'.$d['mon'].'-'.$d['year'] .' '. $d['hours'].':'.$d['minutes'].':' .$d['seconds'];		
	}
}					
?>