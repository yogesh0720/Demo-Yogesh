<?php
	/*
	* @Author: Yogesh Nayi
	* Description: file upload class to be use to adminside
	*/
	class class_file_upload extends class_database {
				
		/*
		* Author: Yogesh Nayi
		* Description: Display the grid section
		*/
		public function select() {

            $params = array(
                $this->searchby,
                $this->searchval,
                $this->page,
                $this->limit,
                $this->sidx,
                $this->sord
            );

            $query = $this->getSPString("file_upload_select", $params);

            $result = $this->mysqli->multi_query( $query );

            if( $result ) // first resultset
            {
                $res_one = $this->mysqli->use_result();

                $rowcountarr = $res_one->fetch_assoc();
                $rowcount = $rowcountarr['totalrows'];

                $res_one->free();
            }

            if( $this->mysqli->next_result() ) // second resultset
            {
                $res_two = $this->mysqli->use_result();

                $totalpagesarr = $res_two->fetch_assoc();
                $totalpages = $totalpagesarr['totalpages'];

                $res_two->free();
            }

            $xml = "<?xml version='1.0' encoding='utf-8'?><rows><page>" . $this->page . "</page><total>" . $totalpages . "</total>"
                . "<records>" . $rowcount . "</records>";

            if( $rowcount > 0 )
            {
                $data_arr = array();
                if( $this->mysqli->next_result() ) // third resultset
                {
                    $res_three = $this->mysqli->use_result();

                    while( $row = $res_three->fetch_assoc() )
                    {
                        $data_arr[] = $row;
                    }

                    $res_three->free();
                }

                foreach( $data_arr as $row )
                {
                    $surl = "";

                    $xml .= "<row id='" . $row["id"] . "'>";

                    $xml .= "<cell><![CDATA[" . $row["title"] . "]]></cell>";
					
                    $xml .= "<cell>" . '.' .strtoupper($row["file_type"]) . "</cell>";
					                 
					$path = "../uploads/admin/important_files/". $row["file_name"];
					
					/*$xml .= "<cell><![CDATA[<a  title='".$row["file_name"]."' class='click-priview'><img src='../images/search.png' width='16' height='16' border='0' /></a>]]></cell>";*/
                   
					if ($row["file_type"] == 'txt'){						
						$icon = "<img src='../images/text_16x16.png' width='16' height='16' border='0' />";
					}else if ($row["file_type"] == 'pdf'){						
						$icon = "<img src='../images/pdf_16x16.png' width='16' height='16' border='0' />";
					}else if ($row["file_type"] == 'doc' || $row["file_type"] == 'docx'){
						$icon = "<img src='../images/word_16x16.png' width='16' height='16' border='0' />";
					}else if ($row["file_type"] == 'csv' || $row["file_type"] == 'xls' || $row["file_type"] == 'xlsx'){
						$icon = "<img src='../images/excel.gif' width='16' height='16' border='0' />";
					}else if ($row["file_type"] == 'ppt' || $row["file_type"] == 'pptx'){
						$icon = "<img src='../images/powerpoint_16x16.png' width='16' height='16' border='0' />";
					}else if ($row["file_type"] == 'jpg' || $row["file_type"] == 'jpeg'){
						$icon = "<img src='../images/jpg20x20.png' border='0' />";
					}else if ($row["file_type"] == 'gif'){
						$icon = "<img src='../images/gif20x20.png' border='0' />";
					}else if ($row["file_type"] == 'png'){
						$icon = "<img src='../images/png20x20.png' border='0' />";
					}
					
				    $xml .= "<cell><![CDATA[<a href='".$path."' target='_blank' title='".$row["file_name"]."' download='".$row["file_name"]."' class='click-download'>".$icon."</a>]]></cell>";
					
                    $xml .= "</row>";
                }
                //end of foreach
            }
            else
            {
                $xml .= "<row id='0'><cell>There is no data for this search.</cell><cell></cell><cell></cell></row>";
            }

            $xml .= "</rows>";
            $xml = str_replace("&", "&amp;",$xml);

            return $xml;
        }
		
		/*
		* Author: Yogesh Nayi
		* Description: Insert operation for file upload
		*/
		public function insert( $paramsArray ) {
			$query = $this->getSPString( 'file_upload_insert', $paramsArray );
            $result = $this->mysqli->query( $query );
			if($result){
				$row = $result->fetch_assoc();
				return $row["id"];
			}
			return "";
        }

        /*
		* Author: Yogesh Nayi
		* Description: Delete operation for file upload section
		*/
        public function delete( $paramsArray ) {
            $query = $this->getSPString( 'file_upload_delete', $paramsArray );
            $result = $this->mysqli->query( $query );
			
			if($result){
				$query1 = "SELECT id,file_name FROM `important_files` WHERE id IN (".$paramsArray[0].")";
            	$result1 = $this->mysqli->query( $query1 );
				
				while ($row1 = $result1->fetch_assoc()){
					$orig_file = "../uploads/admin/important_files".'/'.$row1['file_name'];
					$del_file = "../uploads/admin/deleted_files".'/'.$row1['file_name'];
					
					if (@!copy($orig_file, $del_file)) {
						echo "failed to copy $file...\n";
					}else{
						@unlink($orig_file); // delete orignal file	
					}
				}
			}
        }
		
	}
?>