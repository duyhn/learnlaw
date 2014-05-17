<?php
 class UserHelper extends HtmlHelper{
 	
 function register(){
 		$register="<form action='/luatvnam/users/register' method='POST' id='registration_form'>";
 		$register.="<div class='formcon'><div class='label'>Họ tên </div>";
 		$register.="<div class='input'><input type='text' name='hoten' id='register_name' /></div></div>";
 		$register.="<div class='formcon'><div class='label'>Tên đăng nhập</div>";
 		$register.="<div class='input'><input type='text' name='username' id='register_uername' /><span class='left clear note'>Tên này sẽ dùng để đăng nhập trên Diễn đàn Pháp luật Việt Nam.</span></div></div>";
 		$register.="<div class='formcon'><div class='label'>Email</div>";
 		$register.="<div class='input'><input type='text' name='email' id='register_email' /><span class='left clear note'>Xin hãy nhập đúng địa chỉ email của bạn.</span></div></div>";
 		$register.="<div class='formcon'><div class='label'>Mật khẩu</div>";
 		$register.="<div class='input'><input type='password' name='password' id='register_password' /></div></div>";
 		$register.="<div class='formcon'><div class='label'>Xác nhận mật khẩu</div>";
 		$register.="<div class='input'><input type='password' name='register_password_confirmation' id='register_password_confirmation' /><span class='left clear note'>Xin chọn mật mã cho hồ sơ của bạn. Chú ý: mật mã phải lớn hơn '6 kí tự'.</span></div></div>";
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
 		<input type='reset' id=''  class='buttonre' disabled=true value='Nhập lại' name='reset'/>
 		</div>";
 		$register.="</form>";
 		return $register;
 	}
 	//
 	public function pagination($controller,$action,$idtype,$page,$pagebgin,$pageend,$numberrecord){
 		$pagin="";
 		$pagin.=$this->link('Trước',array('controller' => $controller,'action' => $action,'full_base' => true,$idtype,($page>1?$page-1:1),$pageend),array('class'=>'button' ));
 		if($pagebgin>1)
 			 $pagin.="...";
 		for($i=$pagebgin;$i<$pageend;$i++){
 			$pagin.=$this->link($i,array('controller' => $controller,'action' => $action,'full_base' => true,$idtype,$i,$pageend))."|";
 		}
 		if($pageend<$numberrecord)
 			$pagin.= "...";
 		$pagin.=$this->link('Sau',array('controller' => $controller,'action' =>  $action,'full_base' => true,$idtype,($page<$numberrecord?$page+1:$numberrecord),$pageend),array('class'=>'button' ));
 		return $pagin;
 	}
	//
	function create_adminmenu($username){

		$menu="<ul class='nav'><li class='trangchu'>".$this->link('Trang chủ',array('controller' => '','action' => '','full_base' => true)
		)."</li><li class='gioithieu'>";
		$menu.=$this->link('Quản lý người dùng',array('controller' => 'admin','action' => 'managedUser'));
		$menu.="<li>".$this->link('Quản lý tài liệu',array('controller' => '','action' => '','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý thi',array('controller' => 'admin','action' => 'manageTest','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý câu hỏi',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý tư vấn',array('controller' => 'admin','action' => 'manageConsulting','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý thông báo',array('controller' => 'admin','action' => 'manageNews','full_base' => true))."</li>";

		$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li>";
		$menu.="<li style='float:right'><a>Xin chào: ".$username." </a></li> </ul>";
 		return $menu;
	}
	//
	function create_formManageUser($role,$user,$user_id=null){
		$name="";
		$email="";
		$roleid=0;
		$usname="";
		$action="/luatvnam/admin/admin/createuser";
		if(isset($user) && $user!=null){
			$name=$user['User']['hoten'];
			$email=$user['User']['email'];
			$roleid=$user['User']['idRole'];
			$usname=$user['User']['username'];
			$action="/luatvnam/admin/admin/updateusser";;
		}
		$register="<table><form action='".$action."' method='POST' id='registration_form' name='User'>";
		$register.="<tr><td><label for='register_name'>Họ tên</label></td>";
		$register.="<td><input type='text' name='hoten' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Tên đăng nhập</label></td>";
		$register.="<td><input type='text' name='username' value='".$usname."' id='register_uername' /></td>";
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
		$register.="<td><input type='checkbox' name='ative' id='register_active' /></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
					</div></form>";
		return $register;
	}
	function create_listUer($data){
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<th class='tdstt'>STT</th><th>Họ và tên</th>
					<th>Tên đăng nhập</th>
					<th>Email</th>
					<th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		foreach ($data as $item){
			$class="even";
			if(($i%2)!=0){
				$class="odd";
			}
			$register.="<tr id='trupload' class=". $class ."><td>".$i."</td><td>".$item['User']['hoten']."</td><td>".$item['User']['username']."</td><td>";
			$register.=$item['User']['email']."</td>";
			$register.="<td>".$this->link('Xem',array('controller' => '','action' => '','full_base' => true)).$this->link('Sửa',array('controller' => 'admin','action' => 'formUpdateUser','full_base' => true,$item['User']['user_id']));
			$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleUser','full_base' => true,$item['User']['user_id']))."</td></tr>";
			$i++;
		}
		$register.="</tbody></table>
		<span class='icadd cach'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'managedUser','full_base' => true));
	
		return $register;
	}

	function create_listQuestion($data){
		$register="<table cellspacing='0' class='clear sizeAd'>
					<thead class='tbtailieu'>
					<tr><th class='tdstt'>STT</th><th>Câu hỏi</th><th class='sizeAction'>Tác vụ</th></tr>
					</thead><tbody>";
		$i=1;

		foreach ($data as $item){
		$class="even";
		if(($i%2)!=0){
			$class="odd";
		}
			$register.="<tr id='trupload' class=". $class ."><td>".$i."</td><td>".$item['Question']['title']."</td>";
			$register.="<td>".$this->link('Xem',array('controller' => '','action' => '','full_base' => true)).$this->link('Sửa',array('controller' => 'admin','action' => 'editQuestion','full_base' => true,$item['Question']['id']));
			$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleteQuestion','full_base' => true,$item['Question']['id']))."</td></tr>";
			$i++;
		}
		$register.="</td></tr></tbody></table>
		<div class='left cach'><span class='icadd'></span> ".$this->link('Tạo mới',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</div>";
			
		return $register;
	}

	function create_formManageQuestion($type,$question,$method,$idtype=null){
		$tile="";

		$action="/luatvnam/admin/admin/createQuestion";
		if(isset($question) && $question!=null){
			$tile=$question['Question']['title'];
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
		$register.="<tr><td><label for='register_name'>Nội dung câu hỏi</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='title' id='register_title' >".$tile."</textarea><td></tr>";

		if($method!=null && isset($method)){
			$register.="<tr><td><label>Các Phương án trả lời</label></td><tr>";
			$i=1;
			foreach ($method as $item){
				$register.="<tr><td><label>Phương án ".$i.": ".$this->link('Xóa',array('controller' => 'admin','action' => 'deleteMethod','full_base' => true,$item['Method']['id'],$question['Question']['id']))."</label></td></tr>";
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
		$register.="<table><tr><td><label><a onclick='addmethod()'><span class='icadd'></span>Thêm phương án trả lời</a></label></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
					</div>
					</form>";
		return $register;
	}

	//
	function create_formConsultings($typeConsultings=null,$idTypeconsulting=null){
		$tile="";

		$action="/luatvnam/Tuvan/createConsultings";
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
		$register.="<td><input type='text' name='name' id='register_email' /><td></tr>";
		$register.="<tr><td><label for='register_name'>email</label></td>";
		$register.="<td><input type='text' name='email' id='register_email' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Tiêu đề</label></td>";
		$register.="<td><input type='text' name='title' id='register_title' /><td></tr>";

		$register.="<tr><td><label for='register_name'>Nội dung câu hỏi</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='content' id='register_title' >".$tile."</textarea><td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
					</div>
					</form>";
		return $register;
	}
	//
	function create_listConsultings($data=null){
		$register="<p>Không tìm thấy danh sách câu hỏi</p>";
		print_r($data);
		$consulting=$data[0]['Consulting'];
		if(isset($consulting) && $consulting!=null && count($consulting)>0){
			$register="";
			foreach ($consulting as $item){
				$register.="<p>".$this->link($item['title'],array('controller' => 'Tuvan','action' => 'detail','full_base' => true,$item['id']))."</p>";
			}
		}
		return $register;
	}
	//
	function create_formAdminConsultings($typeConsultings=null,$idTypeconsulting=null,$conlusting=null){
		$tile="";
		$idcons=0;
		if(isset($conlusting) && $conlusting!=null){
			$tile=$conlusting[0]['Consulting']['title'];
			$idcons=$conlusting[0]['Consulting']['id'];
		}
		$action="/luatvnam/admin/admin/createResultconsultings";
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
		$register.="<td><input type='text' name='title' id='register_title' value='".$tile."' readonly/><td></tr>";
		$register.="<input type='hidden' name='consulting_id'  value='".$idcons."' />";
		$register.="<tr><td><label for='register_name'>Nội dung câu trả lời</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='content' id='content' ></textarea><td></tr>";
		$register.="<script type='text/javascript'>CKEDITOR.replace( content); </script>";
		$register.="<tr><td></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
					</div></form>";
		return $register;
	}
	//
	function create_listConsulteds($data,$boolean){//bolean=0 or 1
		$out="";
		foreach ($data as $item){
				if($item['anser']==$boolean){
					$out.="<p>".$this->link($item['consulting'][0]['Consulting']['title'],array('controller' => 'admin','action' => 'AnserConsulting','full_base' => true,$item['consulting'][0]['Consulting']['id']))."</p>";
			}
		}
		return $out;
	}
	
	public function createFormNews($News=null,$idtypeNews=null,$ListtypeNew=null,$page=null,$end=null){
		$tile="";
		$idnews=0;
		$noidung="";
		$action="/luatvnam/admin/admin/createNews";
		if(isset($News) && $News!=null){
			$tile=$News['Tbltintuc']['tieude'];
			$idnews=$News['Tbltintuc']['id_tintuc'];
			$noidung=$News['Tbltintuc']['noidung'];
			$action="/luatvnam/admin/admin/updateNews";
		}
		
		
		$register="<form action='".$action."' method='POST' id='news' name='News'>";
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
		$register.="<td><input type='text' name='tieude' id='register_title' value='".$tile."' /><td></tr>";
		$register.="<input type='hidden' name='id_tintuc'  value='".$idnews."' />";
		$register.="<tr><td><label for='register_name'>Nội dung</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='noidung' id='noidung' >".$noidung."</textarea><td></tr>";
		$register.="<script type='text/javascript'>CKEDITOR.replace( noidung); </script>";	
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
						<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='ok'/>
						<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
					</div></form>";
		return $register;
	}
	public function createListNews($typeNews=null,$page,$end){
		$register="<table><thead><tr><th>stt</th><th>Tin tức</th><th class='sizeAction'>Tác vụ</th></tr></thead><tbody>";
		$i=1;
		$data=$typeNews[0]['Tbltintuc'];
		foreach ($data as $item){
			$register.="<tr><td>".$i."</td><td>".$item['tieude']."</td>";
			$register.="<td>".$this->link('Xem',array('controller' => '','action' => '','full_base' => true)).$this->link('Sửa',array('controller' => 'admin','action' => 'editNews','full_base' => true,$item['id_tintuc'],$page,$end));
			$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleteNews','full_base' => true,$item['id_tintuc'],$page,$end))."</td></tr>";
			$i++;
		}
		$register.="<tr><td></td><td>".$this->link('Tạo mới',array('controller' => 'admin','action' => 'admin_manageNews','full_base' => true))."</td></tr></tbody></table";
			
		return $register;
	}
	/*Menu admin*/
 	function menudoc(){
		$doc= $this->script(array('menu_jquery.js'));
		$doc.="<div id='cssmenu'>
				<ul>
				   <li class='active'><a href='index.html'><span>Home</span></a></li>
				   <li class='has-sub'><a href='#'><span>Quản lý người dùng</span></a>
				      <ul>
				         <li class='has-sub'><a href='#'><span>Product 1</span></a>
				            <ul>
				               <li><a href='#'><span>Sub Item</span></a></li>
				               <li class='last'><a href='#'><span>Sub Item</span></a></li>
				            </ul>
				         </li>
				         <li class='has-sub'><a href='#'><span>Product 2</span></a>
				            <ul>
				               <li><a href='#'><span>Sub Item</span></a></li>
				               <li class='last'><a href='#'><span>Sub Item</span></a></li>
				            </ul>
				         </li>
				      </ul>
				   </li>
				   <li>".$this->link('Quản lý tài liệu',array('controller' => 'Uploads','action' => 'upload','full_base' => true))."</a></li>
				   <li class='last'><a href='#'><span>Contact</span></a></li>
				</ul>
				</div>";
		return $doc;
	}
	/*Menu user 17-5-2014*/
 	function menudocUser(){
		$doc= $this->script(array('menu_jquery.js'));
		$doc.="<div id='cssmenu'>
				<ul>
				   <li class='active'><a href='index.html'><span>Home</span></a></li>
				   <li class='has-sub'><a href='#'><span>Quản lý người dùng</span></a>
				      <ul>
				         <li class='has-sub'><a href='#'><span>Product 1</span></a>
				            <ul>
				               <li><a href='#'><span>Sub Item</span></a></li>
				               <li class='last'><a href='#'><span>Sub Item</span></a></li>
				            </ul>
				         </li>
				         <li class='has-sub'><a href='#'><span>Product 2</span></a>
				            <ul>
				               <li><a href='#'><span>Sub Item</span></a></li>
				               <li class='last'><a href='#'><span>Sub Item</span></a></li>
				            </ul>
				         </li>
				      </ul>
				   </li>
				   <li>".$this->link('Thông tin cá nhân',array('controller' => '','action' => '','full_base' => true))."</a></li>
				   <li class='last'><a href='#'><span>Contact</span></a></li>
				</ul>
				</div>";
		return $doc;
	}
}					
?>