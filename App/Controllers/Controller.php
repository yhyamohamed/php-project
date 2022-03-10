<?php
interface Controller
{
    // public function index();//list all resource data 
    // public function create(); //done       //render form for data create php file and send client to it
    public function store();    //done   //presist new resource data (from request) & redirect 
    public function show($id); //done
    // public function edit($id);  //done  //render data in form to edit 
     public function update($id);  //done   //presist  edits & redirect 
     public function destroy($id);  //done



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
