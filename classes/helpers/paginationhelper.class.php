<?php
class paginationHelper
{
	public function __contruct()
	{
	}
	
	public function __destruct()
	{
	}
	
	public function paginate($data,$results=20,$limit=30)
	{
		$html = "<table id='pulsePaginateTable'><thead><tr>";
		$fields = array_keys($data[0]);
		foreach($fields as $field)
			$html .= "<th>".$field."</th>";
		$html .= "</tr></head><tbody>";

		$pageCount = 0;
		$rowCount = 1;
		foreach($data as $row)
		{
			$html .= "<tr class='page".($pageCount+1)."'>";
			foreach($fields as $field)
				$html .= "<td>".$row[$field]."</td>";
			$html .= "</tr>";
			
			if( ($pageCount+1) == $limit )
			{
				$pageCount++;
				break;
			}
			
			if( ($rowCount%$results) == 0 )
			{
				$rowCount = 1;
				$pageCount++;
				continue;
			}
			$rowCount++;
		}
		$html .= "</tbody></table>";
		
		if( $pageCount > 1 )
		{
			$html .= "<ul id='pulsePaginateNav'>";
			$html .= "<li><a href='javascript:void(0);' onclick='showPage(1)'>First</a></li>";
			$html .= "<li><a href='javascript:void(0);' onclick='showPreviousPage()'>Prev</a></li>";
			for($i = 1; $i <= $pageCount; $i++)
				$html .= "<li><a href='javascript:void(0);' onclick='showPage(".$i.")'>".$i."</a></li>";
			$html .= "<li><a href='javascript:void(0);' onclick='showNextPage()'>Next</a></li>";
			$html .= "<li><a href='javascript:void(0);' onclick='showPage(".$pageCount.")'>Last</a></li>";
			$html .= "</ul>";
			
			$html .= "<script type='text/javascript'>
				showPage(1);
			
				var currentPage = 1;
				var maxPage = ".$pageCount.";
				
				function showNextPage()
				{
					if(currentPage < maxPage)
						currentPage++;
					showPage(currentPage);
				}
				
				function showPreviousPage()
				{
					if(currentPage > 1)
						currentPage--;
					showPage(currentPage);
				}
				
				function showPage(page)
				{
					currentPage = page;
					var myTable = document.getElementById('pulsePaginateTable');
					var myRows = myTable.rows;
					for(var i = 1; i < myRows.length; i++)
					{
						if(myRows[i].className == ('page'+page))
							myRows[i].style.display = 'table-row';
						else
							myRows[i].style.display = 'none';
					}
				}
			</script>";
		}
		echo($html);
	}
}
?>