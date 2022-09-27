<!-- 1. using JS, cloneNode() this input element -->
<!-- 2. Change the name and id of that new element -->
<!-- 3. append that new element somewhere-->
<!-- 4. update the onclick function of the .class-entry div to click on that new element -->

 <input type="file" name="imgUpload" id="imgUpload" accept="image/png, image/jpeg, image/jpg"/>
 <div class="entry-photo" onclick="document.getElementById('imgUpload').click();">
        <label>
            <i id='upload-icon' class='bx bx-cloud-upload bx-md'></i>
            Add photo
        </label>
 </div>