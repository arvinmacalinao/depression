$( document ).ready(function() {
    document.getElementById("mpFilter").style.display = "none";

    $(".close").on('click', function(event){
      document.getElementById("mpFilter").style.display = "none";
    });

    $("#mf_close").on('click', function(event){
        document.getElementById("mpFilter").style.display = "none";
    });


    $("#mf_apply").on('click', function(event){
        let timerInterval
        Swal.fire({
        title: 'Loading...',
        html: '',
        timer: 2000,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
        })
      // alert($('#mf_cmb_province option:selected').attr('id'));
      event.preventDefault();
      removeMarkers();
      let prov_id =  $('#mf_cmb_province option:selected').attr('id');
      let district_id =  $('#mf_cmb_district option:selected').attr('id');
      let projtyp_id =  $('#mf_cmb_prjtype option:selected').attr('id');
      let brand_id =  $('#mf_cmb_equipment option:selected').attr('id');
      let sector_id =  $('#mf_cmb_sector option:selected').attr('id');
      let status_id =  $('#mf_cmb_status option:selected').attr('id');
      let yrFrom =  $('#mf_cmb_yrFrm option:selected').attr('value'); 
      let yrTo =  $('#mf_cmb_yrTo option:selected').attr('value');
      let keyWordz =  document.getElementById("mf_search").value;
      
      let _token   = $('meta[name="csrf-token"]').attr('content');

      if(prov_id == null){
        prov_id = "*"
      }

      if(district_id == null){
        district_id = "*"
      }

      if(projtyp_id == null){
        projtyp_id = "*"
      }

      if(brand_id == null){
        brand_id = "*"
      }

      if(sector_id == null){
        sector_id = "*"
      }

      if(status_id == null){
        status_id = "*"
      }

      if(yrFrom == "--"){
        yrFrom = "*"
      }

      if(yrTo == "--"){
        yrTo = "*"
      }

      if(keyWordz == ""){
        keyWordz = "*"
      }
      

      console.log(yrFrom);
      console.log(yrTo);

      $.ajax({
        url: "/map-filter",
        type: "GET",
        data:{ 
            prov_id: prov_id, 
            district_id: district_id, 
            projtyp_id: projtyp_id, 
            brand_id: brand_id, 
            sector_id: sector_id, 
            status_id:status_id, 
            keyWordz: keyWordz, 
            yrFrom: yrFrom,
            yrTo: yrTo, 
            _token: _token 
        },
        success:function(response){
          var data=response
          jQuery.each(data,function(index, value){

            prj_icon1 = value.prj_type_id;
            prj_icon2 = value.sector_id;
            prj_icon3 = value.prj_status_id;
            prj_icon4 = value.region_id;

          if( prj_icon1  == '6' ){ //Setup Icon
              icon1 = imagePath + "prj_0.png"
          }
  
          if(prj_icon1 == '8' ){ //Roll-out Icon
              icon1 = imagePath + "prj_1.png"
          }
  
          if(prj_icon1 == '9' ){ //Tapi Assisted Icon
              icon1 = imagePath + "prj_2.png"
          }
  
          if(prj_icon1 == '12' ){ //GIA Community Based Icon
              icon1 = imagePath + "prj_3.png"
          }
  
          if(prj_icon1 == '13' ){ //GIA Internally Funded
              icon1 = imagePath + "prj_4.png"
          }
  
          if(prj_icon1 == '14' ){ //GIA Externally Funded
              icon1 = imagePath + "prj_5.png"
          }
  
          //Sector Icons---------------------------------------
  
          if(prj_icon2 == '1' ){ //Food Processing
              icon2 = imagePath + "sec_0.png"
          }
  
          if(prj_icon2 == '2' ){ //Furniture
              icon2 = imagePath + "sec_1.png"
          }
  
          if(prj_icon2 == '3' ){ //Gifts / Decors / Handicrafts
              icon2 = imagePath + "sec_2.png"
          }
  
          if(prj_icon2 == '4' ){ //Metals & Engineering
              icon2 = imagePath + "sec_3.png"
          }
  
          if(prj_icon2 == '5' ){ //Agriculture / Marine / Agriculture / Forestry / Livestock
              icon2 = imagePath + "sec_4.png"
          }
  
          if(prj_icon2 == '7' ){ //Health & Wellness Products
              icon2 = imagePath + "sec_5.png"
          }
  
          if(prj_icon2 == '8' ){ //ICT
              icon2 = imagePath + "sec_6.png"
          }
  
          if(prj_icon2 == '21' ){ //Halal Products & Service
              icon2 = imagePath + "sec_7.png"
          }
  
          if(prj_icon2 == '18' ){ //Other Regional Insdustry Priorites
              icon2 = imagePath + "sec_8.png"
          }
  
          //---------------Status---------------------------//
          if(prj_icon3 == '8' ){ //Completed
              icon3 = imagePath + "stat_0.png"
          }
          if(prj_icon3 == '1' ){ //On-going
              icon3 = imagePath + "stat_1.png"
          }
          if(prj_icon3 == '3' ){ //New
              icon3 = imagePath + "stat_2.png"
          }
          if(prj_icon3 == '4' ){ //Graduated
              icon3 = imagePath + "stat_3.png"
          }
          if(prj_icon3 == '7' ){ //Widthdrawn
              icon3 = imagePath + "stat_4.png"
          }
          if(prj_icon3 == '6' ){ //Terminated
              icon3 = imagePath + "stat_5.png"
          }
  
          //---------------Regional---------------------------//
          if(prj_icon4 == '1' ){ //NCR
              icon4 = imagePath + "reg_0.png"
          }
          if(prj_icon4 == '2' ){ //CAR
              icon4 = imagePath + "reg_1.png"
          }
          if(prj_icon4 == '3' ){ //REGION 1
              icon4 = imagePath + "reg_2.png"
          }
          if(prj_icon4 == '4' ){ //REGION 2
              icon4 = imagePath + "reg_3.png"
          }
          if(prj_icon4 == '5' ){ //REGION 3
              icon4 = imagePath + "reg_4.png"
          }
          if(prj_icon4 == '6' ){ //REGION 4A
              icon4 = imagePath + "reg_5.png"
          }
          if(prj_icon4 == '7' ){ //REGION 4B
              icon4 = imagePath + "reg_6.png"
          }
          if(prj_icon4 == '8' ){ //REGION 5
              icon4 = imagePath + "reg_7.png"
          }
          if(prj_icon4 == '9' ){ //REGION 6
              icon4 = imagePath + "reg_8.png"
          }
          if(prj_icon4 == '10' ){ //REGION 7
              icon4 = imagePath + "reg_9.png"
          }
          if(prj_icon4 == '11' ){ //REGION 8
              icon4 = imagePath + "reg_10.png"
          }
          if(prj_icon4 == '12' ){ //REGION 9
              icon4 = imagePath + "reg_11.png"
          }
          if(prj_icon4 == '13' ){ //REGION 10
              icon4 = imagePath + "reg_12.png"
          }
          if(prj_icon4 == '14' ){ //REGION 11
              icon4 = imagePath + "reg_13.png"
          }
          if(prj_icon4 == '15' ){ //REGION 12
              icon4 = imagePath + "reg_14.png"
          }
          if(prj_icon4 == '16' ){ //CARAGA 
              icon4 = imagePath + "reg_15.png"
          }
          if(prj_icon4 == '17' ){ //ARMM
              icon4 = imagePath + "reg_16.png"
          }
          mergeImages([icon1, icon2, icon3, icon4])
            .then(b64 => { 
              const p1 = new google.maps.Marker({
                position: { lat: parseFloat(value.prj_latitude), lng: parseFloat(value.prj_longitude) },
                map,
                icon: b64
            });

            const infowindow = new google.maps.InfoWindow({
                content: value.prj_title,
            });

            p1.addListener('click', function() {
                pj_addrs = value.prj_address;
                pj_title = value.prj_title;
                pj_prjcode = value.prj_code;
                pj_prjya = value.prj_year_approved;
                pj_prjstat = value.prj_status_id;
                
                pj_region = value.region_code;
                pj_provname = value.province_name;
                pj_distName = value.district_name;
                pj_prjtype = value.prj_type_name;
                pj_sector= value.sector_name;
                pj_coop = value.coop_names;
                pj_collab = value.collaborator_names;
                res_loc = pj_region + "," + pj_provname + "," + pj_distName

                window.document.getElementById("mf_addrs").innerText = value.prj_address;
                window.document.getElementById("mf_prj_title").innerText = value.prj_title;
                window.document.getElementById("b_prj_code").innerText = value.prj_code;
                window.document.getElementById("b_prj_year_approved").innerText = value.prj_year_approved;
                
                window.document.getElementById("mf_location").innerText = res_loc;
                // window.document.getElementById("mf_prov").innerText = pj_provname;
                // window.document.getElementById("mf_district").innerText = pj_distName;

                window.document.getElementById("mf_prjtype").innerText = pj_prjtype;
                window.document.getElementById("mf_sector").innerText = pj_sector;
                window.document.getElementById("mf_coopnames").innerText = pj_coop;
                window.document.getElementById("mf_collabnames").innerText = pj_collab;

                if(pj_prjstat == 1){
                    window.document.getElementById("b_prj_status_name").innerText = "On-going";
                }
                if(pj_prjstat == 3){
                    window.document.getElementById("b_prj_status_name").innerText = "New";
                }
                if(pj_prjstat == 4){
                    window.document.getElementById("b_prj_status_name").innerText = "Graduated";
                }
                if(pj_prjstat == 6){
                    window.document.getElementById("b_prj_status_name").innerText = "Terminated";
                }
                if(pj_prjstat == 7){
                    window.document.getElementById("b_prj_status_name").innerText = "Withdrawn";
                }
                if(pj_prjstat == 8){
                    window.document.getElementById("b_prj_status_name").innerText = "Completed";
                }      
                
                $("a").attr("href", "https://hazardhunter.georisk.gov.ph/index.php?" + "lat=" + value.prj_latitude + "&lng=" + value.prj_longitude);

                $('#mf_modal').modal('show');
            });


            m1.push(p1);
            p1.addListener("mouseover", () => {
                infowindow.open({
                anchor: p1,
                map,
                shouldFocus: false,
                });
            });
            p1.addListener('mouseout', function() {
                infowindow.close();
            });               
            });

          });
        },
        error: function(error) {
         console.log(error);
        }
    });
      
  });

    for (var i = 2012; i <= new Date().getFullYear() + 2; i++) {
        $('#mf_cmb_yrFrm').append( '<option value="'+i+'">'+i+'</option>' );
        $('#mf_cmb_yrTo').append( '<option value="'+i+'">'+i+'</option>' );
    }

    var input = document.getElementById("mf_search");
    input.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
          // Cancel the default action, if needed
          event.preventDefault();
          // Trigger the button element with a click
          document.getElementById("mf_apply").click();
        }
      });

});