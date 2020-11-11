<form action="<?php echo base_url();?>csv/uploadData" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
    <table>
        <tr>
            <td> Choose your file: </td>
            <td>
                <input type="file" class="form-control" name="form1" id="form1"  align="center"/>
            </td>
            <td>
                <div class="col-lg-offset-3 col-lg-9">
                    <button type="submit" name="submit" class="btn btn-info">Upload</button>
                </div>
            </td>
        </tr>
    </table> 
</form>