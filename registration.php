<?php 
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include "master.php";

      if(isset($_POST['submit'])){

        $regId = 'HNB'.date('Y').rand(1000,9999); //Student ID Generation

        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dept = $_POST['department'];
        $year = $_POST['year'];
        $sem = $_POST['semester'];
        $council = $_POST['council'];
        $club=$_POST['club'];
        $social = $_POST['social'];
        $aoi = $_POST['aoi'];
        $password = $_POST['password'];
        $date = date('Y-m-d');

        // $token = bin2hex(random_bytes(16));

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        // try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'saswal086@gmail.com';                     //SMTP username
          $mail->Password   = 'enrkwiasinvmkycm';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      
          //Recipients
          $mail->setFrom('saswal086@gmail.com', 'Councils and Clubs');
          $mail->addAddress($email, $firstName.''.$lastName);     //Add a recipient

          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Email Verification';
          $mail->Body    = '
          <div>
            <h1>HNBGU Councils & Clubs</h1>
            <p>Click on the link provided below to verify your email address and submit your application form.</p>
            <a href="http://localhost/hnbgu-councils-clubs/verification?regid='.$regId.'">Click Here</a>
          </div>';
          // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      
          if($mail->send()){
            $sql = "INSERT INTO `users` (`reg_id`, `firstname`, `lastname`, `email`, `phone`, `department`, `year`, `semester`, `council`, `club`, `social`, `aoi`, `password`,`verified`, `date`) 
                    VALUES ('{$regId}', '{$firstName}', '{$lastName}', '{$email}', '{$phone}', '{$dept}', '{$year}', '{$sem}', '{$council}', '{$club}', '{$social}', '{$aoi}', '{$password}',0, '{$date}')";
            $result = mysqli_query($conn,$sql);  

            if($result){
              redirect('verifyemail.php');
            }else{
              die();
            }
          }else{
            echo "Error Message";
          }
          
      // } catch (Exception $e) {
          // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      // }

        
    }
?>
    <div class="form-wrap">
      <div class="container shadow">
        <div class="row">
          <div class="col-md-12 m-0 p-0 form-heading">
            <h1 class="btn-block">HNBGU Council and Club Registration Form</h1>
          </div>
        </div>
        <div
          class="row justify-content-center align-items-center display-none"
          id="signup"
        >
          <div class="col-md-12">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form p-md-5">
              <div class="row">
                <div class="col-md-6 mt-3 mt-3">
                  <label for="username"
                    >Firstname<span class="imp-op">*</span></label
                  >
                  <input required type="text" name="fname" class="form-control" />
                </div>
                <div class="col-md-6 mt-3 mt-3">
                  <label for="username"
                    >Lastname<span class="imp-op">*</span></label
                  >
                  <input required type="text" name="lname" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mt-3">
                  <label for="password"
                    >Email<span class="imp-op">*</span></label
                  >
                  <input required type="text" name="email" class="form-control" />
                </div>
                <div class="col-md-6 mt-3">
                  <label for="password"
                    >Contact Number<span class="imp-op">*</span></label
                  >
                  <input required type="number" name="phone" class="form-control" />
                </div>
                <!-- <input required type="text" class="form-control"> -->
              </div>
              <div class="row">
                <div class="col-md-6 mt-3">
                  <label for="password"
                    >Department<span class="imp-op">*</span></label
                  >
                  <input required type="text" name="department" class="form-control" />
                </div>
                <div class="col-md-3 mt-3">
                  <label for="password"
                    >Year<span class="imp-op">*</span></label
                  >
                  <select name="year" id="year" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </div>
                <div class="col-md-3 mt-3">
                  <label for="password"
                    >Semester<span class="imp-op">*</span></label
                  >
                  <select name="semester" id="semester" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
                <!-- <input required type="text" class="form-control"> -->
              </div>
              <div class="row">
                <div class="col-md-6 mt-3">
                  <label for="council"
                    >Council (Choose council which you want to join)<span
                      class="imp-op"
                      >*</span
                    ></label
                  >
                  <select name="council" id="council" class="form-control">
                    <option value="00">Choose Council</option>
                    <option
                      value="Technical Council
                    "
                    >
                      Technical Council
                    </option>
                    <option
                      value="Language and Literature Council
                    "
                    >
                      Language and Literature Council
                    </option>
                    <option
                      value="Media and Cultural Council
                    "
                    >
                      Media and Cultural Council
                    </option>
                    <option
                      value="Science Council
                    "
                    >
                      Science Council
                    </option>
                    <option
                      value="Management & Commerce Council
                    "
                    >
                      Management & Commerce Council
                    </option>
                    <!-- <option value=""></option> -->
                  </select>
                </div>
                <div class="col-md-6 mt-3">
                  <label for="council"
                    >Club (Choose club which you want to join)<span
                      class="imp-op"
                      >*</span
                    ></label
                  >
                  <select name="club" id="club" class="form-control">
                    <option value="00">Choose Club</option>
                    <option
                      value="Computer Science Club
                    "
                    >
                      Computer Science Club
                    </option>
                    <option
                      value="Electrical Club
                    "
                    >
                      Electrical Club
                    </option>
                    <option
                      value="Robotics and Instrumental Club
                    "
                    >
                      Robotics and Instrumental Club
                    </option>
                    <option
                      value="Designing Club
                    "
                    >
                      Designing Club
                    </option>
                    <option
                      value="Mechanical Club
                    "
                    >
                      Mechanical Club
                    </option>

                    <option value="Language Club">Language Club</option>
                    <option value="Reading Club">Reading Club</option>
                    <option value="Writing Club">Writing Club</option>
                    <option value="Debate Club">Debate Club</option>
                    <option value="Drama Club">Drama Club</option>
                    <option value="Music Club">Music Club</option>
                    <option value="Poetry Club">Poetry Club</option>
                    <option value="Script Writing Community">
                      Script Writing Community
                    </option>
                    <option value="Video and Media Club">
                      Video and Media Club
                    </option>
                    <option value="Anchor Community">Anchor Community</option>
                    <!-- <option value=""></option> -->
                    <!-- <option value=""></option> -->
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label for="Social"
                    >Social Media Link
                    <span class="imp-op">(optional)</span></label
                  >
                  <input type="url" name="social" class="form-control" />
                </div>
                <div class="col-md-6 mt-3">
                  <label for="aoi"
                    >Area of Interest
                    <span class="imp-op">(optional)</span></label
                  >
                  <input name="aoi" id="aoi" class="form-control" />
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label for="password"
                    >Password<span class="imp-op">*</span></label
                  >
                  <input
                    required
                    type="password"
                    name="password"
                    class="form-control"
                    id="pass"
                  />
                  <span id="passError"></span>
                </div>
                <div class="col-md-6 mt-3">
                  <label for="password"
                    >Confirm Password<span class="imp-op">*</span></label
                  >
                  <input
                    required
                    type="text"
                    class="form-control"
                    id="c-pass"
                    autocomplete="off"
                  />
                  <span id="passError"></span>
                </div>
                <div class="col-md-12">
                  <span class="imp-op imp-op-tx"
                    >Note: Field marked with (*) are mandatory fields.</span
                  >
                </div>
                <!-- <input required type="text" class="form-control"> -->
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <button
                    required
                    name="submit"
                    type="submit"
                    id="reg-submit"
                    class="form-control mt-4"
                    style="cursor:not-allowed"
                    disabled>
                    Submit
                  </button>
                </div>
                <div class="col-md-4">
                  <a
                    href="home"
                    class="text-light nav-link bg-secondary border rounded text-center"
                    ><i class="fas fa-home"></i> Home</a
                  >
                </div>
                <div class="col-md-4 text-center lg-p">
                  <span>Already Registered?</span>
                  <a href="login" class="text-center text-secondary">
                    Login Here</a
                  >
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
