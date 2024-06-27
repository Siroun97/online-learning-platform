
let nav=`  <div class="navbar navbar-expand navbar-dark-pickled-bluewood bg-transparent will-fade-background"
id="default-navbar"
data-primary>

<!-- Navbar toggler -->
<button class="navbar-toggler w-auto mr-16pt d-block rounded-0"
       type="button"
       data-toggle="sidebar">
   <span class="material-icons">short_text</span>
</button>

<!-- Navbar Brand -->
<a href="index.html"
  class="navbar-brand mr-16pt">
   <!-- <img class="navbar-brand-icon" src="public/images/logo/white-100@2x.png" width="30" alt="Luma"> -->

   <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

       <span class="avatar-title rounded bg-primary"><img src="public/images/illustration/student/128/white.svg"
                alt="logo"
                class="img-fluid" /></span>

   </span>

   <span class="d-none d-lg-block">myluma</span>
</a>

<ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
   <li class="nav-item active">
       <a href="index.html"
          class="nav-link">Home</a>
   </li>
   <li class="nav-item dropdown">
       <a href="#"
          class="nav-link dropdown-toggle"
          data-toggle="dropdown"
          data-caret="false">Courses</a>
       <div class="dropdown-menu">
           <a href="course.html"
              class="dropdown-item" >Browse Courses</a>
           <a href="student-course.html"
              class="dropdown-item">Preview Course</a>
           <a href="student-lesson.html"
              class="dropdown-item">Preview Lesson</a>
           <a href="student-take-course.html"
              class="dropdown-item"><span class="mr-16pt">Take Course</span> <span class="badge badge-notifications badge-accent text-uppercase ml-auto">Pro</span></a>
           <a href="student-take-lesson.html"
              class="dropdown-item">Take Lesson</a>
           <a href="student-take-quiz.html"
              class="dropdown-item">Take Quiz</a>
           <a href="student-quiz-result-details.html"
              class="dropdown-item">Quiz Result</a>
           <a href="student-dashboard.html"
              class="dropdown-item">Student Dashboard</a>
           <a href="student-my-courses.html"
              class="dropdown-item"id="coursesLink" >My Courses</a>
           <a href="student-quiz-results.html"
              class="dropdown-item">My Quizzes</a>
           <a href="help-center.html"
              class="dropdown-item">Help Center</a>
       </div>
   </li>
   <li class="nav-item dropdown">
       <a href="#"
          class="nav-link dropdown-toggle"
          data-toggle="dropdown"
          data-caret="false">Paths</a>
       <div class="dropdown-menu">
           <a href="paths.html"
              class="dropdown-item">Browse Paths</a>
           <a href="student-path.html"
              class="dropdown-item">Path Details</a>
           <a href="student-path-assessment.html"
              class="dropdown-item">Skill Assessment</a>
           <a href="student-path-assessment-result.html"
              class="dropdown-item">Skill Result</a>
           <a href="student-paths.html"
              class="dropdown-item">My Paths</a>
       </div>
   </li>
   <li class="nav-item">
       <a href="pricing.html"
          class="nav-link">Pricing</a>
   </li>
   <li class="nav-item dropdown">
       <a href="#" 
          class="nav-link dropdown-toggle"
         
          data-caret="false" id="teacherLink">Teachers</a>
       <div id="teacherdropdown" class="dropdown-menu">
           <a href="instructor-dashboard.html"
              class="dropdown-item">Instructor Dashboard</a>
           <a href="instructor-courses.html"
              class="dropdown-item">Manage Courses</a>
           <a href="instructor-quizzes.html"
              class="dropdown-item">Manage Quizzes</a>
           <a href="instructor-earnings.html"
              class="dropdown-item">Earnings</a>
           <a href="instructor-statement.html"
              class="dropdown-item">Statement</a>
           <a href="instructor-edit-course.html"
              class="dropdown-item">Edit Course</a>
           <a href="instructor-edit-quiz.html"
              class="dropdown-item">Edit Quiz</a>
       </div>
   </li>
   <li class="nav-item dropdown"
       data-toggle="tooltip"
       data-title="Community"
       data-placement="bottom"
       data-boundary="window">
       <a href="#"
          class="nav-link dropdown-toggle"
          data-toggle="dropdown"
          data-caret="false">
           <i class="material-icons">people_outline</i>
       </a>
       <div class="dropdown-menu">
           <a href="teachers.html"
              class="dropdown-item">Browse Teachers</a>
           <a href="student-profile.html"
              class="dropdown-item">Student Profile</a>
           <a href="teacher-profile.html"
              class="dropdown-item">Instructor Profile</a>
           <a href="blog.html"
              class="dropdown-item">Blog</a>
           <a href="blog-post.html"
              class="dropdown-item">Blog Post</a>
           <a href="faq.html"
              class="dropdown-item">FAQ</a>
           <a href="help-center.html"
              class="dropdown-item">Help Center</a>
           <a href="discussions.html"
              class="dropdown-item">Discussions</a>
           <a href="discussion.html"
              class="dropdown-item">Discussion Details</a>
           <a href="discussions-ask.html"
              class="dropdown-item">Ask Question</a>
       </div>
   </li>
</ul>

<ul class="nav navbar-nav ml-auto mr-0">
   <li class="nav-item">
       <a href="login.html"
          class="nav-link"
          data-toggle="tooltip"
          data-title="Login"
          data-placement="bottom"
          data-boundary="window"><i class="material-icons">lock_open</i></a>
   </li>
   <li class="nav-item">
       <a href="signup.html"
          class="btn btn-outline-white" id="navuser">get started</a>
   </li>
   <li class="nav-item">
       <button id="logout" > log out</button>
   </li>
    <li class="nav-item">
       <button id="login" > log in</button>
   </li>
</ul>
</div>`


//console.log(username);
   document.getElementById("navbar").innerHTML=nav;


   var userId;



   $.ajax({


      url: 'api/islogged.php',
      type: 'GET',
      dataType: 'json',
      
      success: function(response) {
          console.log(response);
          if (response.status === 'success') {
            // User is logged in
            if(response.userType=='te'){
               document.getElementById('teacherdropdown').style.visibility = 'hidden';
            }
            else{
               $('#teacherLink').attr('data-toggle', 'dropdown');
                
            }
            console.log("usertpe "+response.userType);
            var username = response.user;
            userId=response.userId;
          
            document.getElementById('navuser').textContent=username;
            $('#coursesLink').attr('href', 'mycourses.html?userId=' + userId);
            $('#teacherLink').attr('href', 'teachers.html');
            $('ul.navbar-nav li:nth-child(4)').hide();
         

         }
         else {
            // User is not logged in, hide the login button
            $('ul.navbar-nav li:nth-child(3)').hide(); // Assuming login button is the first <li>
         
        }
          // Process data for portal names
          
      },
      error: function(xhr, status, error) {
          console.error(xhr.responseText);
      }
  });
  $('#login').click(function() { 
   window.location.href="login.html";
  });
  $('#logout').click(function() { // Updated selector to match the button ID
   // Make AJAX call to logout.php to perform logout
   $.ajax({
       url: 'api/logout.php', // Path to your logout PHP script
       type: 'POST',
      
       success: function(response) {
           // Redirect to the login page upon successful logout
           window.location.href = 'login.html'; // Replace with the path to your login page
       },
       error: function(xhr, status, error) {
           // Handle AJAX errors
           console.error(xhr.responseText);
       }
   });
});