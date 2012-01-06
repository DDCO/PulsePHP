<html>
	<head>
    	<title>Warning</title>
        <style type="text/css">
			body{font-family:Arial, Helvetica, sans-serif}
			div{width:480px; margin:50px auto;}
			table{width:100%;border:black 1px solid;border-collapse:collapse;}
			th{border-bottom:black 1px solid;background-color:#FF3}
			td{border:#CCC thin dotted;}
		</style>
    </head>
    <body>    
        <div>
            <h1>PulsePHP Warning</h1>
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><?php echo($errno." - ".$errstr);?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label>Error Number: </label></td>
                        <td><?php echo($errno);?></td>
                    </tr>
                    <tr>
                        <td><label>Error Message: </label></td>
                        <td><?php echo($errstr);?></td>
                    </tr>
                    <tr>
                        <td><label>File: </label></td>
                        <td><?php echo($errfile);?></td>
                    </tr>
                    <tr>
                        <td><label>Line: </label></td>
                        <td><?php echo($errline);?></td>
                    </tr>
                </tbody>
            </table>
        </div>
	</body>
</html>