<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>


   <button name="edit" class="btn btn-success btn-sm btnAdd" ><i class="fa fa-edit">
       <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
            width="24" height="24" class="like" id="1"
            viewBox="0 0 172 172"
            style=" fill:#000000;"><g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><g fill="#66936c"><path d="M118.96667,150.5h-61.63333c-7.88333,0 -14.33333,-6.45 -14.33333,-14.33333v-68.08333c0,-4.3 2.15,-7.88333 5.01667,-10.75l25.8,-22.21667l6.45,-27.95h5.73333c10.03333,0.71667 28.66667,6.45 28.66667,27.95c0,7.16667 -2.15,15.76667 -4.3,22.21667h32.96667c7.88333,0 14.33333,6.45 14.33333,14.33333v17.2c0,1.43333 -0.71667,3.58333 -1.43333,5.01667l-24.36667,48.73333c-2.15,5.01667 -7.16667,7.88333 -12.9,7.88333zM91.73333,22.93333l-5.01667,20.06667l-29.38333,25.08333v68.08333h61.63333v7.16667v-7.16667l24.36667,-48.01667v-16.48333h-53.75l4.3,-10.03333c0,0 6.45,-15.76667 6.45,-26.51667c0,-7.88333 -5.01667,-10.75 -8.6,-12.18333zM144.05,87.43333v0z"></path><path d="M118.96667,143.33333h-61.63333c-4.3,0 -7.16667,-2.86667 -7.16667,-7.16667v-68.08333c0,-2.15 0.71667,-4.3 2.86667,-5.73333l27.95,-23.65l5.01667,-24.36667c0,0 21.5,0.71667 21.5,20.78333c0,12.18333 -7.16667,29.38333 -7.16667,29.38333h43c4.3,0 7.16667,2.86667 7.16667,7.16667v17.2c0,0.71667 0,1.43333 -0.71667,1.43333l-24.36667,48.73333c-0.71667,2.86667 -3.58333,4.3 -6.45,4.3z" opacity="0.3"></path><path d="M14.33333,57.33333h14.33333v93.16667h-14.33333z"></path></g></g></g></svg>
   </i>Edit</button>
<select name="select1" id="select1">
    <option selected>Select Year</option>
    <option value="1ict">1ICT</option>
    <option value="2ict">2ICT</option>
    <option value="3ict">3IST</option>
</select>

<div id='myStyle'>
    <div id="view">
        View Result!!!!!
    </div>
</div>
<script type="text/javascript">

    $(function() {
        $('#select1').on('change', function(event) {
            $('#myStyle').load('data.php?id=' + this.value);
            document.getElementById("view").style.display = "none";
        });
    });
</script>

<script type="text/javascript">

$(document).ready(function () {
$(".like").click(function (e) {
var employee_id = $(this).attr("id");
alert(employee_id);
});
});

</script>