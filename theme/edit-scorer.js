var scorerId;
var classId = new Array();
var className = new Array();
var classPermissedId = new Array();
var classUnpermissedId = new Array();

var subjectId = new Array();
var subjectName = new Array();
var subjectPermissedId = new Array();
var subjectUnpermissedId = new Array();

function classSubmit() {
    $.get("handler/editScorer.php?action=submitClass&classPermissed=" + JSON.stringify(classPermissedId) + "&scorerId=" + scorerId, function(data) {
        alert(data);
    });
}

function subjectSubmit() {
    $.get("handler/editScorer.php?action=submitSubject&subjectPermissed=" + JSON.stringify(subjectPermissedId) + "&scorerId=" + scorerId, function(data) {
        alert(data);
    });
}

function scorerSubmit(fscorerId) {
    /*
     * First, procedures about class permission, load all && permissed
     */
    scorerId = fscorerId;
    $.get("handler/editScorer.php?action=getClassAll", function(data) {
        return_array = JSON.parse(data);
        classId = return_array.idArray;
        for (i = 0; i < classId.length; i++) {
            className[classId[i]] = return_array.nameArray[i];
        }
        $.get("handler/editScorer.php?action=getClassPermissed&scorerId=" + fscorerId, function(data) {
            classPermissedId = JSON.parse(data);
            classUnpermissedId = compareTwoArray(classId, classPermissedId);
            updateClass();
            /*
             * Then, procedures about subject permission, load all && permissed
             */
            $.get("handler/editScorer.php?action=getSubjectAll", function(data) {
                return_array = JSON.parse(data);
                subjectId = return_array.idArray;
                for (i = 0; i < subjectId.length; i++) {
                    subjectName[subjectId[i]] = return_array.nameArray[i];
                }
                $.get("handler/editScorer.php?action=getSubjectPermissed&scorerId=" + fscorerId, function(data) {
                    subjectPermissedId = JSON.parse(data);
                    subjectUnpermissedId = compareTwoArray(subjectId, subjectPermissedId);
                    updateSubject();
                });
            });
        });
    });
}

function compareTwoArray(array1, array2) {
    var result = new Array();
    var isExist;

    for (var  i  =  0;  i  <  array1.length;  i++) {
        isExist = false;    
        for (var  j  =  0;  j  <  array2.length;  j++) {        
            if (array1[i]  ==  array2[j]) {            
                isExist  =  true;            
                break;        
            }    
        }    
        if (!isExist) {
            result.push(array1[i]);    
        }
    }
    return result;
}

function updateClass() {
    var permissedHTML = "";
    for (i = 0; i < classPermissedId.length; i++) {
        permissedHTML += "<label onclick='classChangeFromPermissed(this.id)' id=" + classPermissedId[i] + ">" + className[classPermissedId[i]] + ";" + " </label>";
    }
    $("#class-permissed").html(permissedHTML);

    var unpermissedHTML = "";
    for (i = 0; i < classUnpermissedId.length; i++) {
        unpermissedHTML += "<label onclick='classChangeFromUnpermissed(this.id)' id=" + classUnpermissedId[i] + ">" + className[classUnpermissedId[i]] + ";" + " </label>";
    }
    $("#class-unpermissed").html(unpermissedHTML);
}

function updateSubject() {
    var permissedHTML = "";
    for (i = 0; i < subjectPermissedId.length; i++) {
        permissedHTML += "<label onclick='subjectChangeFromPermissed(this.id)' id=" + subjectPermissedId[i] + ">" + subjectName[subjectPermissedId[i]] + ";" + " </label>";
    }
    $("#subject-permissed").html(permissedHTML);

    var unpermissedHTML = "";
    for (i = 0; i < subjectUnpermissedId.length; i++) {
        unpermissedHTML += "<label onclick='subjectChangeFromUnpermissed(this.id)' id=" + subjectUnpermissedId[i] + ">" + subjectName[subjectUnpermissedId[i]] + ";" + " </label>";
    }
    $("#subject-unpermissed").html(unpermissedHTML);
}

function classChangeFromUnpermissed(itemId) {
    var i = getIndex(classUnpermissedId, itemId);
    classUnpermissedId.splice(i, 1);
    classPermissedId.push(itemId);
    updateClass();
}

function classChangeFromPermissed(itemId) {
    var i = getIndex(classPermissedId, itemId);
    classPermissedId.splice(i, 1);
    classUnpermissedId.push(itemId);
    updateClass();
}

function subjectChangeFromUnpermissed(itemId) {
    var i = getIndex(subjectUnpermissedId, itemId);
    subjectUnpermissedId.splice(i, 1);
    subjectPermissedId.push(itemId);
    updateSubject();
}

function subjectChangeFromPermissed(itemId) {
    var i = getIndex(subjectPermissedId, itemId);
    subjectPermissedId.splice(i, 1);
    subjectUnpermissedId.push(itemId);
    updateSubject();
}

function getIndex(fArray, fVal) {
    for (i = 0; i < fArray.length; i++)
        if (fArray[i] == fVal)
            return i;
}
