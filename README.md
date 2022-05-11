# 台科大英語自學點數剋星

NTUST English Self-learning Points Nemesis

全自動操作、為您省下大把時間，還可以開出多個視窗同時作答。  
Fully automatic. Huge timesaver. Answer questions in multiple windows at the same time.

![banner](./note/banner.png)

**[!!! WATCH THE DEMO !!!](https://www.youtube.com/watch?v=NDjQtxoEI9c)**

---

你是否為這學期的英語自學點數感到困擾，覺得題目好難？怎麼那麼擊敗？明明就同一份試卷，每次出來的題目順序不一樣就算了，有時連選項都不一樣...一頁一題的試卷類型是否也讓你感到頗崩潰？快試試這個，讓您的英語自學點數任務扶搖直上九萬里！  
Are you tired of the English self-learning program this semester?
The same exam over and over again, with the same questions ordered differently, sometimes even different options...
Is these one-page-at-a-time type of the exam also frustrating you?
Try this and turbocharge your English self-learning program up!

---

## 安裝教學 Installation instructions

1. 安裝這兩個軟體  
   Install these two programs.

   - XAMPP (7.3.6, includes Apache Server, MySQL) [Windows](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.3.6/xampp-windows-x64-7.3.6-4-VC15-installer.exe/download) | [macOS](https://sourceforge.net/projects/xampp/files/XAMPP%20Mac%20OS%20X/7.3.6/xampp-osx-7.3.6-4-installer.dmg/download)
   - Scripty (Chrome plugin) [Install link](https://chrome.google.com/webstore/detail/scripty-javascript-inject/milkbiaeapddfnpenedfgbfdacpbcbam?utm_source=chrome-ntp-icon)

2. 把這個專案檔案丟到下面的資料夾，並且把資料夾重新命名為「fuckMoodle」  
   Put all the files in this repository into the following path and rename the folder to "fuckMoodle".

   - macOS: `/Applications/XAMPP/xamppfiles/htdocs`
   - Windows: `C:\xampp\htdocs`

3. 到 Launchpad 或開始選單把 XAMPP 打開，需要的話輸入密碼  
   Open XAMPP in Launchpad or Start Menu and enter your password if required.

4. 切到 Manage Servers 把 Apache Web Server 跟 MySQL Database 打開 (start)  
   Go to the Manage Servers page and open Apache Web Server and MySQL Database.
   ![xampp running sample](./note/xampp_withCircle.png)

5. 打開瀏覽器，輸入：`http://localhost/phpmyadmin` 進入資料庫管理頁面  
   Open the browser, enter the url: `http://localhost/phpmyadmin` to get into database management page.

6. 新建一個名稱叫「fuck_moodle」的資料庫，編碼類型請選「utf8mb4_unicode_ci」  
   Create a new database called "fuck_moodle" with "utf8mb4_unicode_ci" as encoding type

7. 將`fuck_moodle.sql`匯入到剛剛創建的資料庫  
   Import the file fuck_moodle.sql to the database you just created

8. 用瀏覽器前往 `http://localhost/fuckMoodle` 。如果你看到以下的畫面且沒有其他錯誤就表示 API 佈建完成。  
   Go to `http://localhost/fuckMoodle` in your browser. If you see the following picture and no other errors, it means the APIs are deployed.
   ![佈建完成範例](./note/api_build_successful.png)

9. 到 Scripty 裡面新增一個 Script  
   Add a Script in Scripty Chrome plugin.

   1. Name: 隨便亂打  
      Name: Doesn't matter.
   2. Javascript Code: 到本專案的資料夾中找到檔案`fuckMoodle_withBackend.js`，用文字編輯器將它打開複製起來貼到這裡。  
      Javascript Code: Go to the folder of this project and find the file `fuckmoodle_withbackend.js`, copy all of it in a text editor and paste it here.
   3. Run script if: [URL] [Contains] Following input
   4. 在下方的輸入欄位中輸入這個網址`https://ntustlc.gnomio.com/`  
      Enter this URL below: `https://ntustlc.gnomio.com/`
   5. Trigger: Automatically, Before page load

      ![配置範例](./note/scriptyConfig.png)

10. 打開 `https://ntustlc.gnomio.com/` ，進入你要完成的課程，打開該課程的「成績」，開到作答頁面程式就會自動執行了。  
    Open `https://ntustlc.gnomio.com/` in your browser, click the course you want to finish, and the script will run when you get to answer page.