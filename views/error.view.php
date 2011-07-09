<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Error Page</title>
 </head>
 <body>
  <div style="margin:0 auto;width:400px;border-radius:5px;border:1px yellow solid;background-color:#FF9;padding:10px;">
  	<h1 style="margin-top:0px;">PulsePHP Error Page</h1>
    <table>
     <tbody>
      <tr>
       <td><label>Error Number: </label></td>
       <td><?php echo($errorInfo["type"]);?></td>
      </tr>
      <tr>
       <td><label>Error Message: </label></td>
       <td><?php echo($errorInfo["message"]);?></td>
      </tr>
      <tr>
       <td><label>Filename: </label></td>
       <td><?php echo($errorInfo["file"]);?></td>
      </tr>
      <tr>
       <td><label>Line Number: </label></td>
       <td><?php echo($errorInfo["line"]);?></td>
      </tr>
     </tbody>
    </table>
  </div>
 </body>
</html>
