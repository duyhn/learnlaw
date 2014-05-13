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
 	function create_adminmenu($username){
 	
 		$menu="<ul class='nav'><li class='trangchu'>".$this->link('Trang chủ',array('controller' => '','action' => '','full_base' => true)
 		)."</li><li class='gioithieu'>";
 		$menu.=$this->link('Quản lý người dùng',array('controller' => '','action' => '','full_base' => true));
 		$menu.="<li>".$this->link('Quản lý tài liệu',array('controller' => '','action' => '','full_base' => true))."</li>";
 		$menu.="<li>".$this->link('Quản lý thi',array('controller' => '','action' => '','full_base' => true))."</li></ul>";
 			$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li><";
 			$menu.="<span class='titlelog'>Xin chào: ".$username." </span>";
 		return $menu;
 	}
 }
?>