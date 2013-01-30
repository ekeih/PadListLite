function fieldEntered(id)
{
    id.value = "";
    id.style.background = "white";
    id.style.border = "1px solid #000";
    id.style.color = "#000";
}

function fieldLeft(id)
{
    id.style.border = "1px solid black";
    id.style.background = "#F0F0F0";

}

function checkPadName()
{
    var project = document.getElementById("newProject").value;
    var folder = document.getElementById("newFolder").value;
    var padname = document.getElementById("newPadname").value;
    
    if (project == "" || folder == "" || padname == "" || project == "Category" || folder == "Folder" || padname == "Padname")
   {
        alert("Please enter a valid padname!");
    } else {
        self.location= prefix + project + "_" + folder + "_" + padname;
    }
}
