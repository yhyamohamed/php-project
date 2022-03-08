<?php
interface UserTest
{
    // note: 1- implement setter for database fields
    
    // 2-functions 
    public function login(); 
    public function logout(); 
    public function register(); 
    public function update($id);
    public function delete($id); 
    public function getdata($id);



   
}
