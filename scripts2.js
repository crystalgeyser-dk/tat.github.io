function showMemberNumberInput(className) {
    var memberNumber = prompt("what is your membership number?:");
    if (memberNumber != null && memberNumber.trim() !== "") {
        // サーバーに会員番号を送信する
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "check_membership.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === "valid") {
                        // 会員番号が有効な場合の処理
                        alert("success");
                    } else {
                        // 会員番号が無効な場合の処理
                        alert("Error：your number is not membership number");
                    }
                } else {
                    alert("Error：There is no response from the server.");
                }
            }
        };
        xhr.send("memberNumber=" + encodeURIComponent(memberNumber) + "&className=" + encodeURIComponent(className));
    } else {
        alert("Error：Plese write membership number");
    }
}
