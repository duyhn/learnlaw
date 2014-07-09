<?php
      //  echo $this->Html->meta('icon');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Common->forum_header();
?>
<div id="wrapper">    
<?php echo $this->element('navigation');?>
<div id="mainpanel" class="left">
<div class="border contain">
	<div class="tieudemain left bordertron">Diễn đàn Pháp luật Việt Nam</div>
	<div class="border info">
		<p>Chào mừng bạn đến với Diễn đàn Pháp luật Việt Nam.</p>
		<?php if($this->Session->read("Username")==null){?>
		<p>Nếu đây là lần đầu bạn tham gia diễn đàn, trước tiên hãy xem qua quy định diễn đàn.
		Để có thể tham gia thảo luận trên diễn đàn bạn phải đăng ký làm thành viên. 
		<p><?php
		 	echo $this->Html->link(__('Click vào đây để đăng ký thành viên diễn đàn.'),array('controller'=>'users','action'=>'register'));
		 }
		 ?>
		</p>
		</p> 
	</div>

<div class="cach"></div>

                <table class="size" id="forumindex">
                    <thead class="title">
                        <tr >
                            <th colspan=2 class="ttForum">Trao đổi học tập</th>
                            <th class="colgenner1">Ngày tạo</th>
                            <th style="width:120px;">Chủ đề/Bài gởi</th>
                            <th class="baicuoi">Bài cuối</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        <?php 
                   
                        foreach ($forums as $forum): ?>
                        <tr>
                            <td class="tdImg">
                            	<?php echo $this->Html->image('image/chat-icon.png') ?>
							</td>
                            <td >
                                <?php
                                echo $this->Html->link('<h4>'.$forum['Forum']['name'].'</h4>',
                                                        array('controller'=>'topics','action'=>'index',$forum['Forum']['id']),
                                                        array('escape'=>false));?>
                                <span style="padding:2px 5px 0 5px"><?php echo $forum['Forum']['decription'];?></span>
                                
                            </td>
                            <td>
                            	<?php
                                echo $this->Time->timeAgoInWords($forum['Forum']['created']);
                                ?>
							</td>
                            <td ><p>Chủ đề: <?php echo count($forum['Topic']);?></p>
                           		<p>Bài gửi: <?php echo count($forum['Post']);?></p>
                            </td>
                            <td>
                               <?php
                               if(count($forum['Topic'])>0) {
                                //$post = $forum['Post'][0];
                                $topic=$forum['Topic'][0];
                                echo $this->User->noidungtt(5,$this->Html->link($forum['Topic'][0]['name'],array('controller'=>'topics',
                                                                                            'action'=>'view',
                                                                                            $forum['Topic'][0]['id'])));
                                echo '<p>';
                                echo $this->Time->timeAgoInWords($topic['created']);echo '</p>';
                                echo '<p>by&nbsp;';
                                echo $this->Html->link($topic[0]['User']['User']['username'],array('controller'=>'users',
                                                                                                'action'=>'infoMember',
                                                                                                $topic[0]['User']['User']['user_id']));
                               echo '</p>';
                               }
                               ?>
                                 
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div id="paging" class="right">
                    <?php
                    echo $this->User->pagination("Forums","",null,null,$page,$pagebgin,$pageend,$numberrecord);
             
                       // echo $this->element('paginator');
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