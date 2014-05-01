<?php 
    $this->Paginator->options(array('url' => $this->passedArgs));
?>
<?php echo $this->Form->create('Tblloaitailieu',array('action'=>'search'));?>
    <fieldset>
         <legend><?php __('Tblloaitailieu Search');?></legend>
    <?php
        echo $this->Form->input('tenloai');
        echo $this->Form->input('mota');
        //echo $this->Form->submit('Search');
    ?>
    </fieldset>
<?php echo $this->Form->end('Tblloaitailieu');?>

<?php
if(!empty($posts)){
	
    echo "<table>";
    echo "<tr>";
    echo "<th>".$this->Paginator->sort("idloai","idloai");
    echo "<th>".$this->Paginator->sort("tenloai","tenloai");
    //echo "<th>".$this->Paginator->sort("mota","mota");
    echo "</tr>";
    
    foreach($posts as $item){
        echo "<tr>";
        echo "<td>".$item['Tblloaitailieu']['idloai']."</td>";
        echo "<td>".$item['Tblloaitailieu']['tenloai']."</td>";
       // echo "<td>".$item['Tblloaitailieu']['mota']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    //---- Paging 
   echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
    
    echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
    
    echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
    
    echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
}
else
	echo "not data";
?>