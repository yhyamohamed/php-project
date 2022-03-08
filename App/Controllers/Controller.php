<?php
interface Controller
{
    public function index();//list all resource data 
    public function create();//render form for data
    public function store(User $user);//presist new resource data (from request) & redirect 
    public function show($id);
    public function edit($id);//render data in form to edit 
    public function update($id);//presist  edits & redirect 
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
