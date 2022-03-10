<?php
interface UserTest
{
    // note: 1- implement setter for database fields

    // 2-functions 
    public function login();        //done
    //  public function logout();
     public function register();    //done
     public function update($id);   //done
     public function delete($id);   //done
     public function getdata($id);  //done
}
