 $(document).ready(function()
  {
    
    $(`#parentDashboard`).on('click',function()
    {
        $(`.dasboard`).toggle("fast");
    });

    $(`#parentProductManagement`).on('click',function()
    {
        $(`.productManagement`).toggle("fast");
    });

    $(`#parentAccountManangement`).on('click',function()
    {
        $(`.accountManagement`).toggle("fast");
    });

  });