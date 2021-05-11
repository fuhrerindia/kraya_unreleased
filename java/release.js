                function gbid(id){
                    return document.getElementById(id);
                }
                document.getElementById("close-release-notes-button").addEventListener("click", ()=>{
                    gbid("over-dialog").style.display = "none";
                    document.getElementsByTagName("body")[0].style.overflow = "unset";

                });
                document.getElementById("show-release-notes-button").addEventListener("click", ()=>{
                    gbid("over-dialog").style.display = "inline-block";
                    document.getElementsByTagName("body")[0].style.overflow = "hidden";

                });