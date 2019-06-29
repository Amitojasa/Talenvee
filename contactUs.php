<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="includes/css/contactus.css">
    <div class="bg-light text-dark" id="heading-div" >
        <span class="display-4" id="heading">Contact Us</span>
    </div>
    <div class="container border p-3 my-3">
        <form action="mailto.php"  method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">E-mail Id</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="E-mail Id">
            </div>
            <div class="form-group">
                <label for="msg">Message</label>
                <textarea name="msg" id="msg" class="form-control" rows="5" placeholder="Message"></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary w-50">Submit</button>
            </div>

        </form>
    </div>





<?php include 'includes/footer.php'; ?>