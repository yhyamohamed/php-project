<?php

namespace App\Controllers;

interface Controller
{
    public function index(); //list all resource data 
    public function create($mail, $pass); //render form for data
    public function store($user); //presist new resource data (from request) & redirect 
    public function show($username, $pass,$rememberMeFlag);
    public function search($useremail);
    public function edit($id,$email,$pass); //render data in form to edit 
    public function update($id,$user); //presist  edits & redirect 
    public function destroy($id);



    // Verb	        URI	                Action	    Route-Name
    // ==============================================================
    // GET	        /photos	            index	    photos.index
    // GET	        /photos/            create	    create	photos.create
    // POST	        /photos	            store	    photos.store
    // GET	        /photos/{photo} 	show	    photos.show
    // GET	        /photos/{photo}/    edit	    edit	photos.edit
    // PUT/PATCH	/photos/{photo}	    update	    photos.update
    // DELETE	    /photos/{photo}	    destroy	    photos.destroy
}
