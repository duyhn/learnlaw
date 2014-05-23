<style>
ul.pagination .active,
ul.pagination .disabled {
  float: left;
  padding: 3px 11px 4px 11px;
  text-decoration: none;
  border: 1px solid;
}
 
ul.pagination .active {
  background-color: #428bca;
  border-color: #428bca;
}
 
ul.pagination .disabled {
   color: #999;
   cursor: not-allowed;
   background-color: #fff;
   border-color: #ddd;
}
 
ul.pagination  > li:first-child {
    border-left-width: 1px;
    -webkit-border-bottom-left-radius: 4px;
    border-bottom-left-radius: 4px;
    -webkit-border-top-left-radius: 4px;
    border-top-left-radius: 4px;
    -moz-border-radius-bottomleft: 4px;
    -moz-border-radius-topleft: 4px;
}
 
ul.pagination > li:last-child  {
    -webkit-border-top-right-radius: 4px;
    border-top-right-radius: 4px;
    -webkit-border-bottom-right-radius: 4px;
    border-bottom-right-radius: 4px;
    -moz-border-radius-topright: 4px;
    -moz-border-radius-bottomright: 4px;
}
</style>
 
<ul class="pagination pagination-sm">
   <?php
    echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
    echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
    echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
    echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
?> 
</ul>
