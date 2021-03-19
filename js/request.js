let modifier = false;
let upID = 0;
let delid = 0;

var fisrtname = document.getElementById("txtfirstname");
var lastname = document.getElementById("txtlastname");
var nickname = document.getElementById("txtnickname");
var favsuperhero = document.getElementById("txtfavhero");
var address = document.getElementById("txtaddress");
fisrtname.addEventListener("keyup", function(event){

    if (event.keyCode == 13)
    {
        onsave()
    }
})
lastname.addEventListener("keyup", function(event){

    if (event.keyCode == 13)
    {
        onsave()
    }
})
nickname.addEventListener("keyup", function(event){

    if (event.keyCode == 13)
    {
        onsave()
    }
})
favsuperhero.addEventListener("keyup", function(event){

    if (event.keyCode == 13)
    {
        onsave()
    }
})
address.addEventListener("keyup", function(event){

    if (event.keyCode == 13)
    {
        onsave()
    }
})
function onsave()
{
    if (modifier == true)
    {
        var array2 = {
            "updata1": fisrtname.value,
            "updata2": lastname.value,
            "updata3": nickname.value,
            "updata4": favsuperhero.value,
            "updata5": address.value,
            "updatetrigger" : 4,
            "id" : upID
        };
        update(array2);
    }
    else
    {
        var arrdata1 = {
            "data1": fisrtname.value,
            "data2": lastname.value,
            "data3": nickname.value,
            "data4": favsuperhero.value,
            "data5": address.value,
            "insertrigger": 2
            
        };
            validate(arrdata1)
    }
}
function validate(arrdata1)
{
    if (!arrdata1.data1 || !arrdata1.data2 || !arrdata1.data3 || !arrdata1.data4 || !arrdata1.data5)
    {
        alert("Pls Input All Fields!!!");
    }
    else
    {
        trowdata(arrdata1)
    }
}
function trowdata(arrdata1)
{
    $.ajax({
                method: 'post',
                url: 'controllers/dataController.php',
                data: arrdata1,

                success: function(response)
                {
                    var hammer = JSON.parse(response);
                    if (hammer.statusCode == 200)
                    {
                        alert("Data has been Saved");
                        window.location.href = "http://localhost/BackendActivity01-master/"
                    }
                }
    })
}
function edit(id)
{
    $.ajax({
        method: 'post',
        url: "controllers/dataController.php",
        data: {
                trigger: 1,
                id: id
        },

        success: function(response)
        {
            console.log(response);
            var hammer = JSON.parse(response);
            modifier = true;
            upID = id;
            var resetbtn = document.getElementById("onreset");

            if (modifier == true)
            {
                document.getElementById("onupdate").innerHTML = "UPDATE";
                resetbtn.style.display = "block"
                document.getElementById("txtfirstname").value = hammer.fname;
                document.getElementById("txtlastname").value = hammer.lname;
                document.getElementById("txtnickname").value = hammer.nname;
                document.getElementById("txtfavhero").value = hammer.heroname;
                document.getElementById("txtaddress").value = hammer.adress;
            }
            else
            {
                resetbtn.style.display = "none"
            }

        }
    })
}
function update(array2)
{
    $.ajax({
                method: 'post',
                url: "controllers/dataController.php",
                data: array2,
                        
                      

                success: function(saloinsiupdate)
                {
                    
                    var hammer = JSON.parse(saloinsiupdate);
                    if (hammer.statusUpdate == 400)
                    {
                        alert("Successfully updated" + " " + upID);
                        window.location.href = "http://localhost/BackendActivity01-master/"
                    }
                    
                }
            })
    
}
function onreset1()
{
    modifier = false;
    var resetbtn = document.getElementById("onreset");
    document.getElementById("onupdate").innerHTML = "SUBMIT";
    if (modifier == false)
    {
        resetbtn.style.display = "none"
        document.getElementById("txtfirstname").value = null;
        document.getElementById("txtlastname").value = null;
        document.getElementById("txtnickname").value = null;
        document.getElementById("txtfavhero").value = null;
        document.getElementById("txtaddress").value = null;
    }
}
function ondelete(id)
{
    delid = id;
    var quest = document.getElementById("onmodal");
    quest.innerHTML = "Are you sure you want to delete this ID:" + " " + id;
}
function onyes()
{
    $.ajax({
        method: 'post',
        url: "controllers/dataController.php",
        data: {id: delid,
                deletetrigger: 3
              },

        success: function(response)
        {
            var nabasag = JSON.parse(response);

            if (nabasag.statusDelete == 300)
            {
                alert("Successfully Deleted");
                window.location.href = "http://localhost/BackendActivity01-master/index.php";
            }

        }
    })
}

