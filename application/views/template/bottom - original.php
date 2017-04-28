
</div>
<!-- /#wrapper -->


<script>
    $(document).ready(function() {

        // add items
        var removeButton = "<input type='button' id='remove' class='btn btn-danger' value='Remove'>";
        $('#additems').click(function() {
            $('div.items:last').after($('div.items:first').clone());
            $('div.items:last').append(removeButton);
        });

        // remove items
        $('#remove').click(function() {
            $(this).closest('div.items').remove();
        });

        // preview image
        $("#shipment_pictures").on('change', function() {

            var countFiles = $(this)[0].files.length;

            //$.each( obj, function( key, value ) {alert( key + ": " + value );});
            $('#shipment_pictures_name').val($(this)[0].files[0].name);
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-holder");
            image_holder.empty();
            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof(FileReader) != "undefined") {

                    for (var i = 0; i < countFiles; i++)
                    {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("<img/>", {
                                "src": e.target.result,
                                "class": "thumb-image",
                                "width": "100%",
                            }).appendTo(image_holder);
                        }
                        image_holder.show();
                        reader.readAsDataURL($(this)[0].files[i]);
                    }
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Pls select only images");
            }
        });
    });

    function getTanggal(id) {
        $("#" + id).datepicker({
            dateFormat: 'yy-mm-dd'
        }).datepicker('setDate', document.getElementById(id).value);
    }
</script>
</body>

</html>
