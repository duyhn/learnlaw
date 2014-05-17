<?php
      //  echo $this->Html->meta('icon');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Common->create_heaeder();
?>
<div id="wrapper">    
<?php echo $this->element('navigation');?>
<div id="mainpanel" class="left">
<div class="border contain">
	<div class="tieudemain left bordertron">Diễn đàn Pháp luật Việt Nam</div>
	<div class="border info">
		<p>Chào mừng bạn đến với Diễn đàn Pháp luật Việt Nam.</p>
		<p>Nếu đây là lần đầu bạn tham gia diễn đàn, trước tiên hãy xem qua quy định diễn đàn.
		Để có thể tham gia thảo luận trên diễn đàn bạn phải đăng ký làm thành viên. Click vào đây để đăng ký thành viên diễn đàn.
		</p> 
	</div>

<div class="cach"></div>

                <table class="size">
                    <thead class="title">
                        <tr >
                            <th colspan=2 class="ttForum">Trao đổi học tập</th>
                            <th class="colgenner1">Ngày tạo</th>
                            <th>Chủ đề/Bài gởi</th>
                            <th class="baicuoi">Bài cuối</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        <?php foreach ($forums as $forum): ?>
                        <tr>
                            <td class="tdImg">
                            	<?php echo $this->Html->image('image/chat-icon.png') ?>
							</td>
                            <td>
                                <?php
                                echo $this->Html->link('<h4>'.$forum['Forum']['name'].'</h4>',
                                                        array('controller'=>'topics','action'=>'index',$forum['Forum']['id']),
                                                        array('escape'=>false));
                                ?>
                            </td>
                            <td>
                            	<?php
                                echo $this->Time->timeAgoInWords($forum['Forum']['created']);
                                ?>
							</td>
                            <td><p>Chủ đề: <?php echo count($forum['Topic']);?></p>
                           		<p>Bài gửi: <?php echo count($forum['Post']);?></p>
                            </td>
                            <td>
                               <?php
                               if(count($forum['Post'])>0) {
                                $post = $forum['Post'][0];
                                echo $this->Html->link($post['Topic']['name'],array('controller'=>'topics',
                                                                                            'action'=>'view',
                                                                                            $post['Topic']['id']));
                                echo '&nbsp;';
                                echo $this->Time->timeAgoInWords($post['created']);
                                echo '&nbsp;<small>by</small>&nbsp;';
                                echo '&nbsp;';
                                echo $this->Html->link($post['User']['username'],array('controller'=>'users',
                                                                                                'action'=>'profile',
                                                                                                $post['User']['user_id']));
                               }
                               ?>
                                 
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="right">
                    <?php
                        echo $this->element('paginator');
                    ?>
                 </div>
                 <div class="tieudemain left bordertron">Thống kê diễn đàn</div>
					<div class="border info left">
						<p>Tổng số thành viên: <?php echo $data;?></p></p>
						<p>Tổng số Chủ đề: <?php echo $countTopic;?></p> 
						<p>Tổng số Bình luận: <?php echo $countPost;?></p> 
					</div>
          </div>
          <div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
</div>         
          
</div>
</div>