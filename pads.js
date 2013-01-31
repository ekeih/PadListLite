/*

#################################################################################
#                                                                               #
#  PadListLite gives you a simple overview about your EtherpadLite-Pads.        #
#  Copyright (C) 2013  Max Rosin  git@hackrid.de                                #
#                                                                               #
#  This program is free software: you can redistribute it and/or modify         #
#  it under the terms of the GNU Affero General Public License as published by  #
#  the Free Software Foundation, either version 3 of the License, or            #
#  (at your option) any later version.                                          #
#                                                                               #
#  This program is distributed in the hope that it will be useful,              #
#  but WITHOUT ANY WARRANTY; without even the implied warranty of               #
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                #
#  GNU Affero General Public License for more details.                          #
#                                                                               #
#  You should have received a copy of the GNU Affero General Public License     #
#  along with this program.  If not, see <http://www.gnu.org/licenses/>.        #
#                                                                               #
#################################################################################

*/




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
