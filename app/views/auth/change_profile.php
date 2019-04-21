<div class="bg">
    <div class="container">
        
          <div class="profile-text">
            <h3>Change profile image</h3>
        </div>
            <form  class="fill" action="<?= URL ?>/user/change" method="post" class="form clearfix newform"  enctype="multipart/form-data">

            <label for="image">Select profile image</label>
            <input id="image" type="file" name="image" />
            <br>
            <br>
            <span class="form__btn--group">
                <input type="submit" value="Update Profile" class="btn btn-orange" name="submit_change_profile">
            </span>
        </form>
    </div>
</div>