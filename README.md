# 台科大英語自學點數剋星
__NTUST self-study English points Nemesis__

全自動操作、為您省下大把時間，還可以開出多個視窗同時作答。  
This software is automatic operation.
You can save a lot of time, and answer questions in multiple windows at the same time.


![banner](./note/banner.png)

##### [!!! WATCH THE DEMO !!!](https://www.youtube.com/watch?v=NDjQtxoEI9c)

----
你是否為這學期的英語自學點數感到困擾，覺得題目好難？怎麼那麼擊敗？明明就同一份試卷，每次出來的題目順序不一樣就算了，有時連選項都不一樣...一頁一題的試卷類型是否也讓你感到頗崩潰？快試試這個，讓您的英語自學點數任務扶搖直上九萬里！  
Are you troubled by the self-study of English this semester?
The same test, each question in a different order, sometimes even different options...
Is the page-for-page type of the exam also frustrating you?
Try this and get your English self-study task up to ninety thousand miles!
<hr>

### 你得先安裝以下軟件與插件
#### First, you need to install the following software and plugins.

1. XAMPP(7.3.6, includes Apache Server, MySQL) [Windows](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.3.6/xampp-windows-x64-7.3.6-4-VC15-installer.exe/download)  |  [macOS](https://sourceforge.net/projects/xampp/files/XAMPP%20Mac%20OS%20X/7.3.6/xampp-osx-7.3.6-4-installer.dmg/download)

2. Scripty (Chrome plugins) [install link](https://chrome.google.com/webstore/detail/scripty-javascript-inject/milkbiaeapddfnpenedfgbfdacpbcbam?utm_source=chrome-ntp-icon)

<hr>

### 安裝教學
#### Installation instructions

1. 去裝上面寫到的兩個東西  
   Install the two programs written above.
2. 把我這個專案檔案丟到下面的資料夾，並且把資料夾重新命名為「fuckMoodle」  
   Put all the files in the repository into the following folder and rename the folder to "fuckMoodle".
   ```
   macOS: /Applications/XAMPP/xamppfiles/htdocs
   Windows: C:\xampp\htdocs
   ```
3. 到 "启动台" 把XAMPP打開，要你輸入密碼你就輸入  
   Open XAMPP and enter a password if required.
4. 切到Manage Servers把Apache Web Server跟MySQL Database打開(start)  
   Go to the Manage Servers page and open Apache Web Server and MySQL Database.
   ![xampp running sample](./note/xampp_withCircle.png)
5. 打開瀏覽器，輸入：`http://localhost/phpmyadmin` 進入資料庫管理頁面  
   Open the browser, enter the url: http://localhost/phpmyadmin to get into database management page
6. 新建一個名稱叫"fuck_moodle"的資料庫，編碼類型請選「utf8mb4_unicode_ci」  
   Create a new database called "fuck_moodle" with "UTF8MB4_unicode_CI" as encoding type
7. 將`fuck_moodle.sql`匯入到剛剛創建的資料庫  
   Import the file fuck_moodle.sql to the database you just created
8. 在網址列輸入`http://localhost/fuckMoodle` ，如果你看到以下的畫面且沒有其他錯誤就表示API佈建完成。  
   Type http://localhost/fuckMoodle in your browser url, if you see the following picture and no other errors. It means the api are complete.
   ![佈建完成範例](./note/api_build_successful.png)
9. 到Scripty裡面新增一個Script  
   Add a Script to Scripty in the Chrome plugin
      1. Name: 隨便亂打  
         Name: Custom, unlimited.
      2. Javascript Code: 到本專案的資料夾中找到檔案`fuckMoodle_withBackend.js`，用文本編輯器將它打開複製起來貼到這裡。  
         Javascript Code: Go to the folder of this project and find the file 'fuckmoodle_withbackend. js', open it in a text editor and paste it here.
      3. Run script if: [URL] [Contains] Following input
      4. 在下方的輸入欄位中輸入這個網址`https://ntustlc.gnomio.com/`  
         Enter this URL at the bottom of this line: https://ntustlc.gnomio.com/
      5. Trigger: Automatically, Before page load
      ![配置範例](./note/scriptyConfig.png)
11. 打開 https://ntustlc.gnomio.com/ ，進入你要完成的課程，打開該課程的「成績」，開到作答頁面程式就會自動執行了。  

<br>

> 以上翻译结果来自-有道神经网络翻译(NMT)  
> https://fanyi.youdao.com/