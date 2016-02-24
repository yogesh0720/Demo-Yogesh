function getQuerystring(key, default_)
{
  if (default_==null) default_="";
  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
  var qs = regex.exec(window.location.href);
  if(qs == null)
    return default_;
  else
    return qs[1];
}

var pid = getQuerystring('PID');
var spid = getQuerystring('SPID');

querystr = "&PID=" + pid + "&SPID=" + spid;

jQuery("#bigset").jqGrid({
    url: 'file_upload.php?action=grid',//+querystr,
    datatype: "xml",
    height: "auto",
    autowidth: true,
    colNames: ['Title', 'Type', 'Download'],
    colModel: [
		  { name: 'title', index: 'title', width: 150, sortable: true, editable: false, align: 'left' },
		  { name: 'file_type', index: 'file_type', width: 100, sortable: true, editable: false, align: 'left' },
		  { name: 'download', index: 'download', width: 100, sortable: false, editable: false, align: 'center' }
	  ],
    rowNum: 50,
    rowList: [50, 70, 100],
    imgpath: "images",
    mtype: "get",
    pager: jQuery('#pagerb'),
    sortname: 'create_date',
    viewrecords: true,
    rownumbers: false,
    gridview: true,
    sortorder: "Desc",
    multiselect: true
});
