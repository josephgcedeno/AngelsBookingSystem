  $(document).ready(function()
    {

     
      /*This will get the date of the booking*/
      $(`.close`).on('click',function()
      {
          $(`.alert`).hide("slow"); //ALERT HIDER

      })

      var items = [];
      $.ajax({
           url: 'js/calendar.json',
           dataType: 'json',
           success: function(data) 
           {           
                 
                      $.each(data, function(key, val) 
                      {
                             if (val.client_status=='confirm') 
                             {   
                                    items.push(val)
                             }
                         //items.push('<li id="' + key + '">' + val + '</li>');    
                       
                      });
                
                      var toPrint=$('#days').html('');//CLEARING THE DAYS INNERT HTML
                      var today = new Date(); // first param for year , second for the month, third for days
                      var d=new Date(today.getFullYear(),(today.getMonth()+1),0).toString().split(" ");
                      var monthVal=parseInt((today.getMonth()));//IDENTIFY THE CURRENT MONTH
                      $('#selected').html(exactMonth(monthVal));//CHANGE THE VALUE IN SELECT TO A PARTICULAR MONTH
                      var week=new Date(2020,today.getMonth(),1).toString().split(" "); //IDENTIFYING THE FIRST DAY OF THE MONTH
                      toSetNumba1First(week[0],d[2]);
                      var countBookThatDay=0;
                      var idsFromPlottedDate=[];

                      for(var i=0;i<d[2];i++)
                      {    
                         var plotDay;
                            if (i+1>9 && (today.getMonth())<10) 
                            {
                                 plotDay=`${today.getFullYear()}-0${(today.getMonth()+1)}-${i+1}`;
                            }
                            else if(i<9 && (today.getMonth())<10) 
                            {
                                 plotDay=`${today.getFullYear()}-0${(today.getMonth()+1)}-0${i+1}`;
                            }
                            else if(i<9 && (today.getMonth())>10) 
                            {
                                 plotDay=`${today.getFullYear()}-${(today.getMonth()+1)}-0${i+1}`;
                            }
                            else if(i+1>9 && (today.getMonth())>10) 
                            {
                                 plotDay=`${today.getFullYear()}-${(today.getMonth()+1)}-${i+1}`;
                            }
                            for(var j=0;j<items.length;j++)
                            {   
                            
                                if (plotDay==items[j]['client_ordered']) 
                                {
                                    countBookThatDay++;
                                    idsFromPlottedDate.push(items[j]['id']);
                                }
                            }

                            if (countBookThatDay>0) 
                            {
                                $('#days').append(`<li><span class="active" id="${idsFromPlottedDate}">
                                    ${i+1}</span></li>`);
                                countBookThatDay=0;
                                idsFromPlottedDate=[];
                            }
                            else
                            {
                                $('#days').append(`<li>${i+1}</li>`);

                            }
                            

                            
                      }


           
                  

                      $('#selected').on('change',function()
                      {
                        var toPrint=$('#days').html('');
                        var monthVal=parseInt($('#selected').val());
                        var updated=new Date(2020,parseInt(monthVal)+1,0).toString().split(" ");
                        var weeked=new Date(2020,parseInt(monthVal),1).toString().split(" ");
                        var idsFromPlottedDateSelect=[];

                        toSetNumba1First(weeked[0],updated[2]);
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && (today.getMonth())<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(monthVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && (today.getMonth())<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(monthVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && (today.getMonth())>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(monthVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && (today.getMonth())>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(monthVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['client_ordered']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDateSelect.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDateSelect}">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDateSelect=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                              }


                      });



                      $('.prev').on('click',function()
                      {
                        var toPrint=$('#days').html('');
                        var monthVal=parseInt($('#selected').val())-1;
                        var idsFromPlottedDatePrev=[];
                      
                        if (monthVal-1==-2) 
                        {
                          monthVal=11;
                        }
                        updateVal=monthVal;

                        $('#selected').html(exactMonth(updateVal));
                        var updated=new Date(2020,updateVal+1,0).toString().split(" ");
                        var weeked=new Date(2020,parseInt(updateVal),1).toString().split(" ");

                        toSetNumba1First(weeked[0],updated[2]);
                     
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['client_ordered']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDatePrev.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDatePrev}">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDatePrev=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                                    

                                    
                              }

                      });

                      $('.next').on('click',function()
                      {
                        $('#days').html('');
                        var monthVal=parseInt($('#selected').val())+1;
                        var idsFromPlottedDateNext=[];
                      
                        if (monthVal+1==13) 
                        {
                          monthVal=0;
                        }
                        updateVal=monthVal;

                        $('#selected').html(exactMonth(updateVal));
                        var updated=new Date(2020,updateVal+1,0).toString().split(" ");
                        var weeked=new Date(2020,parseInt(updateVal),1).toString().split(" ");

                        toSetNumba1First(weeked[0],updated[2]);
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['client_ordered']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDateNext.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDateNext}">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDateNext=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                                    

                                    
                              }

                      });


                      $('#year').on('change',function()
                      {
                        var toPrint=$('#days').html('');
                        var monthVal=parseInt($('#selected').val());
                        var year=$('#year').val();
                        updateVal=monthVal;
                        var idsFromPlottedDateYear=[];


                        $('#selected').html(exactMonth(updateVal));
                        var updated=new Date(year,updateVal+1,0).toString().split(" ");
                        var weeked=new Date(year,parseInt(updateVal),1).toString().split(" ");

                        toSetNumba1First(weeked[0],updated[2]);
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && updateVal<10) 
                                    {
                                         plotDay=`${year}-0${(updateVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && updateVal<10) 
                                    {
                                         plotDay=`${year}-0${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && updateVal>10) 
                                    {
                                         plotDay=`${year}-${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && updateVal>10) 
                                    {
                                         plotDay=`${year}-${(updateVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['client_ordered']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDateYear.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDateYear}">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDateYear=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                                    

                                    
                              }



                              
                      });



       $('span.active').on('click',function()
                    {
                       var modal = document.getElementById("myModal");
                       var span = document.getElementsByClassName("close")[0];   
                        modal.style.display = "block";
                       var contentPanelId = (jQuery(this).attr("id")).split(",");
                       $('.modal-body').html('');

                          span.onclick = function() 
                          {
                                  modal.style.display = "none";
                          }
                          window.onclick = function(event) 
                          {
                              if (event.target == modal) 
                              {
                                modal.style.display = "none";
                              }
                          }

                    });
                    $('#myModal').on('click',function()
                    {
                        $('#myModal').hide();
                    });


                    
            }
            
      });


                    

    });

function exactMonth(month)
  {
    if (month==0) 
    {
     return `
     <option value="0" selected>Jan</option>
         <option value="1">Feb</option>
         <option value="2">March</option>
         <option value="3">April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;

    }
    else if (month==1) 
    {

     return `
     <option value="0" >Jan</option>
         <option value="1" selected>Feb</option>
         <option value="2">March</option>
         <option value="3">April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==2) 
    { 
       return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" selected>March</option>
         <option value="3">April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==3) 
    {
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" selected>April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==4) 
    { 
     
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" selected>May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==5) 
    {
     
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" selected>June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==6) 
    {
      return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" selected>July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==7) 
    {
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" selected>August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==8) 
    {
    return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" selected>Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==9) 
    {
    return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" >Sept</option>
         <option value="9" selected>Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==10) 
    {
      return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" >Sept</option>
         <option value="9" >Oct</option>
         <option value="10" selected>Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==11) 
    {
    return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" >Sept</option>
         <option value="9" >Oct</option>
         <option value="10" >Nov</option>
         <option value="11" selected>Dec</option>
         `;
    }

  }

    function toSetNumba1First(week,lastDay)
    {
      if (week=='Sat') 
      {
        $('#days').append(`<li  style="opacity:0.2;">${lastDay-5}</li><li style="opacity:0.2;">${lastDay-4}</li><li style="opacity:0.2;">${lastDay-3}</li><li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Mon') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Tue') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Wed') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Thu') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-3}</li><li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Fri') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-4}</li><li style="opacity:0.2;">${lastDay-3}</li><li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else
      {
        $('#days').append(``);
      }
    }