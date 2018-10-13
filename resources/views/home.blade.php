@extends('layouts.app')
<?php
$message="";
?>
@section('content')
<div class="container">

  <div class="row" >
      <div class="col-md-12 cardv card-1" >
        <div class='row'>
            <div class="col-md-4" >
              What do you want to do?
            </div>

            <div class="col-md-8" >
              <select class='form-control' id='selectwhere'>
                <option value=''>---Please Select---</option>
                <option value='1'>Letter Templating</option>
                <option value='2'>Image with QR Code Templating</option>
              </select>
            </div>
        </div>

      </div>
  </div>


    <div class="row"  id='section1' style='display:none'>
        <div class="col-md-8 card-1" style='background:#d9e3ea;'>
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <textarea id="txtEditor" ></textarea>

                </div>
            </div>
        </div>


        <div class="col-md-4 card-1" style='background:white;'>
            <br/>
            <div class="panel panel-default">


                <div class="panel-body">
                  <br/>

                  <div class='row'>
                      <div class="col-md-6" >
                      <input type="file"  id="files"  class="form-control" accept=".csv" required >
                      </div>

                      <div class="col-md-5" >
                      <input type="button" value="Upload" class="form-control btn-primary" id="submit-file">
                      </div>
                  </div>
                  <br/>
                  <div class='row'>


                      <div class="col-md-11"  style="padding: 10px;border-style:groove;margin:5px;border-radius:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info">
                          Controls
                          </div>

                          </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-4" >
                              PaperType<select id='papertype' class="form-control">
                                <option value='A4'> A4</option>
                                <option value='A3'> A3</option>
                                <option value='A5'> A5</option>
                                <option value='A6'> A6</option>
                                <option value='A7'> A7</option>
                              </select>
                            </div>

                            <div class="col-md-8" >
                              Orientation<select id='orientation' class="form-control">

                                <option value='P'>PORTRAIT</option>
                                <option value='L'>LANDSCAPE</option>
                              </select>
                            </div>
                        </div>

                        <div class='row'>


                            <div class="col-md-5" >
                              Embed Code<select id='codetype' class="form-control">
                               <option value=''>None</option>
                                <option value='QR'> QR Code</option>
                                <option value='BR'> BAR Code</option>

                              </select>
                            </div>
                            <div class="col-md-4" >
                              Code Align<select id='code_align' class="form-control">
                                <option value=''>None</option>
                                <option value='L'>Left</option>
                                <option value='R'>Right</option>
                                <option value='C'>Center</option>
                              </select>
                            </div>

                            <div class="col-md-3" >
                              Color<input id='color1' type='color' style='height:30px;' value='#ffffff' class="form-control" onchange="componentToHex(this.value);"/>

                            </div>
                        </div>


                        <div class='row'>


                            <div class="col-md-12" >
                              Quantity <input type='number' value='1' style='text-align:center'class="form-control" id='quantity'>
                            </div>
                        </div>

                    </div>
                      <div class="col-md-1" >
                      </div>
                  </div>
                  <div class='row'>
                      <div class="col-md-6" >
                        <input type="button" value="Preview" class="form-control btn-primary" id='preview1'>
                      </div>

                      <div class="col-md-5" >
                      <button  class="form-control btn-success" id='genpdfcsv'>
                        <span class="glyphicon glyphicon-print"></span> Finalize
                      </button>
                      </div>
                  </div>


                  <div id='loading'></div>
                  <br/>

                  <div class='row'>

                      <div class="col-md-12" style='height:120px;overflow: auto;' >
                        <div class="alert alert-info">
                      Replace each part of the template with column Identifier eg <b>:Name</b>
                      </div>
                        <div id='parsed_csv_list'>
                          <table>
                            <tr>
                              <th>:Name</th>
                              <th>:Age</th>
                              <th>:Date</th>
                            </tr>
                            <tr>
                              <td>row1 data1</td>
                              <td>row1 data2</td>
                              <td>row1 data3</td>
                            </tr>
                            <tr>
                              <td>row2 data1</td>
                              <td>row2 data2</td>
                              <td>row2 data3</td>
                            </tr>
                          </table>
                        </div>


                      </div>


                  </div>



              </div>

                </div>
            </div>
        </div>




        <!---START OF SECTION 2-->
        <div class="row"  id='section2' style='display:none'>
            <div class="col-md-8 card-1" style='background:#d9e3ea;'>
                <div class="panel panel-default">

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class='row'>
                          	<form action="uploadimage" method="post" enctype="multipart/form-data">
                          <div class="col-md-12" >
                            <div class="col-md-8" >
                            <input type="file"  name="photo"  class="form-control" accept="image/*" required >
                            </div>

                            <div class="col-md-4" >
                            <input type="submit" value="Upload" class="form-control btn-primary" id="submit-file2">
                               <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                          </div>
                          </form>
                        </div>
                        <div class='row'>
                          @if(isset($files))

                          <script>
                          $('#section2').show();
                          $('#section1').hide();
                          scroll();
                          </script>
                                 @foreach($files as $FileRow)
                                    <div class="col-md-12" >
                                      <br/><br/>
                                        <img src="{{$FileRow['src']}}" alt="Lights" style="width:100%;" ></a>
                                      </div>

                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-4 card-1" style='background:white;'>
                <div class="panel panel-default">


                    <div class="panel-body">

                      <div class='row'>


                          <div class="col-md-11"  style="padding: 10px;border-style:groove;margin:5px;border-radius:5px;">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="alert alert-info">
                              Controls
                              </div>

                              </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6" >
                                  PaperType<select id='papertype2' class="form-control">
                                    <option value='A4'> A4</option>
                                    <option value='A3'> A3</option>
                                    <option value='A5'> A5</option>
                                    <option value='A6'> A6</option>
                                    <option value='A7'> A7</option>
                                  </select>
                                </div>

                                <div class="col-md-6" >
                                  Orientation<select id='orientation2' class="form-control">

                                    <option value='P'>PORTRAIT</option>
                                    <option value='L'>LANDSCAPE</option>
                                  </select>
                                </div>
                            </div>

                            <div class='row'>


                                <div class="col-md-6" >
                                  Embed Code<select id='codetype2' class="form-control">
                                   <option value=''>None</option>
                                    <option value='QR'> QR Code</option>
                                    <option value='BR'> BAR Code</option>

                                  </select>
                                </div>
                                <div class="col-md-6" >
                                  Code Align<select id='code_align2' class="form-control">
                                    <option value=''>None</option>
                                    <option value='L'>Left</option>
                                    <option value='R'>Right</option>
                                    <option value='C'>Center</option>
                                  </select>
                                </div>

                            </div>

                            <div class="row">
                              <div class="col-md-6" >
                                Code Color
                                <input id='color2' type='color' style='height:30px;' value='#ffffff'  class="form-control" onchange="componentToHex(this.value);"/>

                              </div>
                              <div class="col-md-6" >
                                 Code Background
                                 <input id='color2' type='color' style='height:30px;' value='#ffffff'  class="form-control" onchange="BackgroundcomponentToHex(this.value);"/>

                                </div>
                            </div>

                            <div class='row'>


                                <div class="col-md-6" >
                                  Code Width
                                    <!--start + - ------------->
                                    <div class="count-input space-bottom">
                                  <a class="incr-btn codeWidth" data-action="decrease" href="#">–</a>
                                  <input class="codeWidth form-control" type="text" name="codeWidth" id="codeWidth" value="50" />
                                  <a class="incr-btn codeWidth" data-action="increase" href="#">&plus;</a>
                              </div>

                                      <!--End + - ------------->

                                  <!--<input type='number' value='50' style='text-align:center'class="form-control" id='codeWidth'>-->
                                </div>
                                <div class="col-md-6" >
                                  Code Height

                                  <!--start + - ------------->
                                  <div class="count-input space-bottom">
                                <a class="incr-btn codeHeight" data-action="decrease" href="#">–</a>
                                <input class="codeHeight form-control " type="text" name="codeHeight" id="codeHeight" value="50" />
                                <a class="incr-btn codeHeight" data-action="increase" href="#">&plus;</a>
                            </div>

                                    <!--End + - ------------->
                                  <!-- <input type='number' value='50' style='text-align:center'class="form-control" id='codeHeight'>-->
                                </div>
                            </div>

                            <div class='row'>


                                <div class="col-md-6" >
                                  Code X axis
                                  <!--start + - ------------->
                                  <div class="count-input space-bottom">
                                <a class="incr-btn code_x" data-action="decrease" href="#">–</a>
                                <input class="code_x form-control" type="text" name="code_x" id="code_x" value="0" />
                                <a class="incr-btn code_x" data-action="increase" href="#">&plus;</a>
                            </div>

                                    <!--End + - ------------->

                                  <!--<input type='number' value='0' style='text-align:center'class="form-control" id='code_x'>-->
                                </div>
                                <div class="col-md-6" >
                                  Code Y axis
                                  <!--start + - ------------->
                                  <div class="count-input space-bottom">
                                <a class="incr-btn code_y" data-action="decrease" href="#">–</a>
                                <input class="code_y form-control" type="text" name="code_y" id="code_y" value="5" />
                                <a class="incr-btn code_y" data-action="increase" href="#">&plus;</a>
                            </div>

                                    <!--End + - ------------->
                                  <!--<input type='number' value='5' style='text-align:center'class="form-control" id='code_y'>-->
                                </div>
                            </div>

                            <div class='row'>

                                <div class="col-md-6" >
                                  Quantity
                                  <!--start + - ------------->
                                  <div class="count-input space-bottom">
                                <a class="incr-btn quantity2" data-action="decrease" href="#">–</a>
                                <input class="quantity2 form-control " type="text" name="quantity2" id="quantity2" value="1" />
                                <a class="incr-btn quantity2" data-action="increase" href="#">&plus;</a>
                            </div>

                                    <!--End + - ------------->
                                  <!--<input type='number' value='1' style='text-align:center'class="form-control" id='quantity2'>-->
                                </div>
                                <div class="col-md-6" >
                                  No per Batch
                                  <!--start + - ------------->
                                  <div class="count-input space-bottom">
                                <a class="incr-btn noPerBatch" data-action="decrease" href="#">–</a>
                                <input class="noPerBatch form-control " type="text" name="noPerBatch" id="noPerBatch" value="2" />
                                <a class="incr-btn noPerBatch" data-action="increase" href="#">&plus;</a>
                            </div>

                                    <!--End + - ------------->
                                  <!--<input type='number' value='2' style='text-align:center'class="form-control" id='noPerBatch'>-->
                                </div>
                            </div>

                        </div>
                          <div class="col-md-1" >
                          </div>
                      </div>
                      <div class='row'>
                          <div class="col-md-6" >
                            <input type="button" value="Preview" class="form-control btn-primary" id='preview2'>
                          </div>

                          <div class="col-md-5" >
                          <button  class="form-control btn-success" id='genpdfimage2'>
                            <span class="glyphicon glyphicon-print"></span> Finalize
                          </button>
                          </div>
                      </div>


                      <div id='loading2'></div>
                      <br/>




                  </div>

                    </div>
                </div>
            </div>
        <!--END OF SECTION 2--->




    </div>
</div>
@endsection

@section('script')
<script>
  var csvdata;
  var colorArr=[0,0,0,0];
  var BackgroundcolorArr=[0,0,0,0];


  var jqteStatus = true;
  	$(".status").click(function()
  	{
  		jqteStatus = jqteStatus ? false : true;
  		$('.jqte-test').jqte({"status" : jqteStatus})
  	});

    $('#selectwhere').on('change', function() {

      var where=$('#selectwhere').val();

      switch (where) {
        case '1':{
            $('#section1').show();
            $('#section2').hide();
            scroll();
            break;
        }

       case '2':{
         $('#section2').show();
         $('#section1').hide();
         scroll();
           break;
       }

        default:

      }
    })

    $('#submit-file').on("click",function(e){
    	e.preventDefault();
    	$('#files').parse({
    		config: {
    			delimiter: "auto",
    			complete: displayHTMLTable,
    		},
    		before: function(file, inputElem)
    		{
    			console.log("Parsing file...", file);
    		},
    		error: function(err, file)
    		{
    			console.log("ERROR:", err, file);
    		},
    		complete: function()
    		{
    			console.log("Done with all files");
    		}
    	});
    });

    function displayHTMLTable(results){

      $("#parsed_csv_list").html("<center><div class='loader'></div></center>");
    	var table = "<table class='table'>";
    	var data = results.data;
      csvdata=data;
    console.table(data);
    	for(i=0;i<data.length;i++){
    		table+= "<tr>";
    		var row = data[i];
    		var cells = row.join(",").split(",");
        var c=0;
    		for(j=0;j<cells.length;j++){
          if(i==0){
            if(cells[j].length<1){
              continue;
            }
            c+=1;
            table+= "<td>";
            table+="<b>:"+cells[j]+"</b>";
            table+= "</th>";
          }else{
            if(cells[j].length<1){
              continue;
            }
            table+= "<td>";
            table+= cells[j];
            table+= "</th>";
          }

    		}
    		table+= "</tr>";
    	}
    	table+= "</table>";

      setTimeout(function(){ $("#parsed_csv_list").html(table); }, 2000);

    }



      $('#preview1').click(function () {

        var papertype=$('#papertype').val();
        var orientation=$('#orientation').val();
        var code_align=$('#code_align').val();
        var codetype=$('#codetype').val();
        var quantity=$('#quantity').val();
        $('#quantity').val();
        var html=$("#txtEditor").Editor("getText");

        if(quantity <1){
          alert('Please Enter a valid Amount');
          return;
        }
        var mydata = {
				  papertype:papertype,
				  orientation: orientation,
				  code_align: code_align,
				  codetype: codetype,
				  quantity: quantity,
				  csvdata: csvdata,
				  htmldata: html,
          isImage:0,
          codecolor:colorArr

		      };
          if(code_align!='' || codetype!=''){


            if(code_align.length<1 || codetype.length<1){
              alert('Please Select a valid Embed code and its alignment');
              return;
            }
          }



        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $("#loading").html("<center><div class='loader'></div></center>");
        $.post("genpdfpreview",
              mydata,
                function(data,status){
                      console.log(data);
                      var obj = JSON.parse(data);
                      if(!obj){
                        alert('An error has occured. Please try again');
                        return;
                      }
                      var batch=obj.batch;
                      setTimeout(function(){
                        $("#loading").html("");
                        window.open('{{asset('')}}'+batch,'1530715094585','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
                        return false;
                      }, 1000);



              });

  });






        $('#preview2').click(function () {

          var papertype=$('#papertype2').val();
          var orientation=$('#orientation2').val();
          var code_align=$('#code_align2').val();
          var codetype=$('#codetype2').val();
          var quantity=$('#quantity2').val();
          var noPerBatch=$('#noPerBatch').val();
          var codeHeight=$('#codeHeight').val();
          var codeWidth=$('#codeWidth').val();
          var code_x=$('#code_x').val();
          var code_y=$('#code_y').val();
          var html='';

          if(quantity <1){
            alert('Please Enter a valid Amount');
            return;
          }
          var mydata = {
  				  papertype:papertype,
  				  orientation: orientation,
  				  code_align: code_align,
  				  codetype: codetype,
  				  quantity: quantity,
  				  csvdata: csvdata,
  				  htmldata: html,
            isImage:1,
            codecolor:colorArr,
            backgroundCodeColor:BackgroundcolorArr,
            noPerBatch:noPerBatch,
            codeHeight:codeHeight,
            codeWidth:codeWidth,
            code_x:code_x,
            code_y:code_y

  		      };
            if(code_align!='' || codetype!=''){
              if(code_align.length<1 || codetype.length<1){
                alert('Please Select a valid Embed code and its alignment');
                return;
              }
            }



          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $("#loading2").html("<center><div class='loader'></div></center>");
          $.post("genpdfpreview",
                mydata,
                  function(data,status){
                        console.log(data);

                        var obj = JSON.parse(data);
                         if(!obj){
                           alert('An error has occured. Please try again');
                           return;
                         }
                        var batch=obj.batch;
                        setTimeout(function(){
                          $("#loading2").html("");
                          window.open('{{asset('')}}'+batch,'1530715094585','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
                          return false;
                        }, 1000);



                });

    });



  $('#genpdfcsv').click(function () {

    var papertype=$('#papertype').val();
    var orientation=$('#orientation').val();
    var code_align=$('#code_align').val();
    var codetype=$('#codetype').val();
    var quantity=$('#quantity').val();
    var html=$("#txtEditor").Editor("getText");

    if(quantity <1){
      alert('Please Enter a valid Amount');
      return;
    }
    var mydata = {
      papertype:papertype,
      orientation: orientation,
      code_align: code_align,
      codetype: codetype,
      quantity: quantity,
      csvdata: csvdata,
      htmldata: html,
      isImage:0,
      codecolor:colorArr,
      backgroundCodeColor:BackgroundcolorArr

      };
      if(code_align!='' || codetype!=''){
        if(code_align.length<1 || codetype.length<1){
          alert('Please Select a valid Embed code and its alignment');
          return;
        }
      }



    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  $("#loading").html("<center><div class='loader'></div></center>");
    $.post("genpdffinal",
          mydata,
            function(data,status){
                  console.log(data);
                  setTimeout(function(){
                    $("#loading").html("");
                    alert('Files Generated Successfully');
                      return false;
                  }, 1000);



          });

});


$('#genpdfimage2').click(function () {

  var papertype=$('#papertype2').val();
  var orientation=$('#orientation2').val();
  var code_align=$('#code_align2').val();
  var codetype=$('#codetype2').val();
  var quantity=$('#quantity2').val();
  var noPerBatch=$('#noPerBatch').val();
  var codeHeight=$('#codeHeight').val();
  var codeWidth=$('#codeWidth').val();
  var code_x=$('#code_x').val();
  var code_y=$('#code_y').val();
  var html='';

  if(quantity <1){
    alert('Please Enter a valid Amount');
    return;
  }
  var mydata = {
    papertype:papertype,
    orientation: orientation,
    code_align: code_align,
    codetype: codetype,
    quantity: quantity,
    csvdata: csvdata,
    htmldata: html,
    isImage:1,
    codecolor:colorArr,
    backgroundCodeColor:BackgroundcolorArr,
    noPerBatch:noPerBatch,
    codeHeight:codeHeight,
    codeWidth:codeWidth,
    code_x:code_x,
    code_y:code_y

    };
    if(code_align!='' || codetype!=''){
      if(code_align.length<1 || codetype.length<1){
        alert('Please Select a valid Embed code and its alignment');
        return;
      }
    }



  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
$("#loading2").html("<center><div class='loader'></div></center>");
  $.post("genpdffinal",
        mydata,
          function(data,status){
                console.log(data);
                setTimeout(function(){
                  $("#loading2").html("");
                  alert('Files Generated Successfully');
                    return false;
                }, 1000);



        });

});

function scroll(){
   $(document).scrollTop($(document).height());
}


function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}
function componentToHex(color){

var colorTemp=hexToRgb(color);
console.log(colorTemp);
colorArr=[];
colorArr.push(colorTemp['r']);
colorArr.push(colorTemp['g']);
colorArr.push(colorTemp['b']);
console.log(colorArr);

}


function BackgroundcomponentToHex(color){

var colorTemp=hexToRgb(color);
console.log(colorTemp);
BackgroundcolorArr=[];
BackgroundcolorArr.push(colorTemp['r']);
BackgroundcolorArr.push(colorTemp['g']);
BackgroundcolorArr.push(colorTemp['b']);
console.log(BackgroundcolorArr);

}

$("#codetype2").change(function(){
  $('#codeWidth').val('50');
  $('#codeHeight').val('50');

  if($("#codetype2").val()=="BR"){

    $('#codeWidth').val('0.2');
    $('#codeHeight').val('18');
  }
});


</script>

<script>
$(".codeWidth").on("click", function (e) {
    var $button = $(this);
    var oldValue = $('#codeWidth').val();
    $button.parent().find('.codeWidth[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
            $button.addClass('inactive');
        }
    }
    $button.parent().find('#codeWidth').val(newVal);
    e.preventDefault();
});


$(".codeHeight").on("click", function (e) {
    var $button = $(this);
    var oldValue = $('#codeHeight').val();
    $button.parent().find('.codeHeight[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
            $button.addClass('inactive');
        }
    }
    $button.parent().find('#codeHeight').val(newVal);
    e.preventDefault();
});


$(".code_x").on("click", function (e) {
    var $button = $(this);
    var oldValue = $('#code_x').val();
    $button.parent().find('.code_x[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
            $button.addClass('inactive');
        }
    }
    $button.parent().find('#code_x').val(newVal);
    e.preventDefault();
});

$(".code_y").on("click", function (e) {
    var $button = $(this);
    var oldValue = $('#code_y').val();
    $button.parent().find('.code_y[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
            $button.addClass('inactive');
        }
    }
    $button.parent().find('#code_y').val(newVal);
    e.preventDefault();
});


$(".quantity2").on("click", function (e) {
    var $button = $(this);
    var oldValue = $('#quantity2').val();
    $button.parent().find('.quantity2[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
            $button.addClass('inactive');
        }
    }
    $button.parent().find('#quantity2').val(newVal);
    e.preventDefault();
});


$(".noPerBatch").on("click", function (e) {
    var $button = $(this);
    var oldValue = $('#noPerBatch').val();
    $button.parent().find('.noPerBatch[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
            $button.addClass('inactive');
        }
    }
    $button.parent().find('#noPerBatch').val(newVal);
    e.preventDefault();
});
</script>

@endsection
