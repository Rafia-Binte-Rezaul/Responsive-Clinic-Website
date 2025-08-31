<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointment_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if (isset($_GET['doctor_id'])) {
  $doctor_id = intval($_GET['doctor_id']); // Sanitize input
  $sql = "SELECT schedule_id, date_time FROM schedule WHERE doctor_id = $doctor_id";
  $result = $conn->query($sql);

  $slots = [];
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $slots[] = $row;
      }
  }
  echo json_encode($slots); // Return JSON for dynamic population
  exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST["name"]);
  $email = $conn->real_escape_string($_POST["email"]);
 
  $doctor_details = $conn->real_escape_string($_POST["doctor_details"]);
  $details = explode("--", $doctor_details);
  $doctor_id = $details[0];
  $doctor_name = $details[1];

  $schedule_details = $conn->real_escape_string($_POST["schedule_details"]);
  $s_details = explode("-->", $schedule_details);
  $schedule_id = $s_details[0];
  $schedule_date_time = $s_details[1];
 
  $contact = $conn->real_escape_string($_POST["contact"]);
  $address = $conn->real_escape_string($_POST["address"]);
  $date_birth = $conn->real_escape_string($_POST["date_birth"]);
  $remarks = $conn->real_escape_string($_POST["remarks"]);

  $sql = "INSERT INTO appointments (name, email, doctor_id, booking_slot, contact, address, date_of_birth, remarks)
          VALUES ('$name', '$email', '$doctor_id', '$schedule_id', '$contact', '$address', '$date_birth', '$remarks')";

  if ($conn->query($sql) === TRUE) {
    // Show alert message with form details
    echo 
    "<script>
      alert('Your appointment has been booked successfully!\\n' +
              'Appointment Details:\\n' +
              'Doctor Name: $doctor_name\\n' +
              'Appointment Date & Time: $schedule_date_time\\n' +
              'Patient Name: $name\\n' +
              'Email: $email\\n' +
              'Contact: $contact\\n' +
              'Date of Birth: $date_birth\\n' +
              'Address: $address\\n' +
              'Remarks: $remarks');
    </script>";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // SEND EMAIL ////////////////////////

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
    $mail->isSMTP();                                       //Send using SMTP
    $mail->SMTPAuth   = true;                              //Enable SMTP authentication
    $mail->Host       = 'smtp.gmail.com';                  //Set the SMTP server to send through
    $mail->Username   = 'rafiabinterezaul7@gmail.com';          //SMTP username
    $mail->Password   = 'fkex kmbg mmqn fddm';                //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    //Enable TLS encryption
    $mail->Port       = 587;                               //TCP port to connect to; use 587 if you have set `SMTPSecure`


    //Recipients
    $mail->setFrom('rafiabinterezaul7@gmail.com', 'DermaCare');
    $mail->addAddress('rafiabinterezaul7@gmail.com', 'Admin');     //Add a recipient
  

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Appointment Notification';

    $mail->Body = '
      <h2 style="color: #4CAF50;">New Appointment Details</h2>
      <p>Dear Team,</p>
      <p>You have received a new appointment. Below are the details of the patient:</p>
      <table style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Doctor Name:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $doctor_name . '</td>
          </tr>
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Appointment Date & Time:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $schedule_date_time . '</td>
          </tr>
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Patient Name:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $name . '</td>
          </tr>
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Email:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $email . '</td>
          </tr>
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Contact:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $contact . '</td>
          </tr>
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Date of Birth:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $date_birth . '</td>
          </tr>
          <tr>
              <td style="padding: 8px; border: 1px solid #ddd;"><strong>Address:</strong></td>
              <td style="padding: 8px; border: 1px solid #ddd;">' . $address . '</td>
          </tr>
      </table>
      <br>
      <p>Thank you,</p>
      <p><strong>DermaCare</strong></p>
    ';

    $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
    
}

  // Check connection
  //if ($conn->connect_error) {
  //    die("Connection failed: " . $conn->connect_error);
  //}

  // Define the query
  $sql = "SELECT * FROM doctor";

  // Execute the query and store the result
  $result = $conn->query($sql);
  $result2 = $conn->query($sql);

  $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
    rel="stylesheet"
  />
    <link rel="stylesheet" href="style.css">
    
    
    <title>Rezaul Rafia Binte | HealthCare</title>
</head>

<body>

    <header>
      <nav class="section__container nav__container">
        <div class="nav__logo">DeRma<span>CaRe</span></div>
        <ul class="nav__links">
            <li class="link"><a href="#">Home</a></li>
            <li class="link"><a href="#about">About Us</a></li>
            <li class="link"><a href="#service">Service</a></li>
            <li class="link"><a href="#doctor">Our Doctors</a></li>
            <li class="link"><a href="#blog">Blog</a></li>
        </ul>

        <button class="btn"> <a href="#booking-form-container">Book an Appointment</a></button>
    </nav>

    <div class="section__container header__container">
        <div class="header__content">
        <h1>Transform Your Skin at Darmacare Clinic</h1>
        <p>Discover the secret to radiant, healthy skin. At Darmacare Center, we deliver expert care, revolutionary treatments, and personalized solutions tailored just for you. Trust us to redefine your skin's beauty and confidence!</p>

        <button class="btn">Reveal Your Glow</button>

        </div>

        <!-- <div class="header__form">
            <form>
              <h4>Book Now</h4>
              <input type="text" placeholder="First Name" />
              <input type="text" placeholder="Last Name" />
              <input type="text" placeholder="Address" />
              <input type="text" placeholder="Phone No." />
              <button class="btn form__btn">Book Appointment</button>
            </form>
        </div> -->
    </div>
    </header>

    <section class="section__container doctors__container" id="doctor">
      <div class="doctors__header">
        <div class="doctors__header__content">
          <h2 class="section__header">Our Special Doctors</h2>
          <p>
            We take pride in our exceptional team of doctors, each a specialist
            in their respective fields.
          </p>
        </div>
        <div class="doctors__nav">
          <span><i class="ri-arrow-left-line"></i></span>
          <span><i class="ri-arrow-right-line"></i></span>
        </div>
      </div>
      
      <div class="doctors__grid">
        <?php
          // Check if there are results
          if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "
                  <div class='doctors__card'>
                    <div class='doctors__card__image'>
                      <img src=". $row["doctor_image"] ." />
                      <div class='doctors__socials'>
                        <span>Book an Appointment</span>
                        <!-- <span><i class='ri-facebook-fill'></i></span>
                        <span><i class='ri-heart-fill'></i></span>
                        <span><i class='ri-twitter-fill'></i></span> -->
                      </div>
                    </div>
                    <h4>" . $row["name"] . "</h4>
                    <p> ". $row["specialist"] . "</p>
                  </div>          
                ";
                // echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
            }
          } else {
            echo "No doctors found.";
          }
        ?>

      </div>
    </section>


    <section class="section__container about__container" id="about">
        <div class="about__content">
          <h2 class="section__header">About Us</h2>
          <p>
            Welcome to our healthcare website, your one-stop destination for
            reliable and comprehensive health care information. We are committed
            to promoting wellness and providing valuable resources to empower you
            on your health journey.
          </p>
          <p>
            Explore our extensive collection of expertly written articles and
            guides covering a wide range of health topics. From understanding
            common medical conditions to tips for maintaining a healthy lifestyle,
            our content is designed to educate, inspire, and support you in making
            informed choices for your health.
          </p>
          <p>
            Discover practical health tips and lifestyle advice to optimize your
            physical and mental well-being. We believe that small changes can lead
            to significant improvements in your quality of life, and we're here to
            guide you on your path to a healthier and happier you.
          </p>
        </div>
        <div class="about__image">
          <img src="find-provider-masks-r3.jpg" />
        </div>
      </section>

      

      <div class="background" id="booking-form-container">
        <div class="booking-form">
            <h2 class="Form_header">DerRma<span>CaRe</span></h2>
            <form id="form" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required/>


 
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required/>

               
               
                <label for="doctors">Doctors:</label>
                  <select name="doctor_details" id="doctors" required>
                      <option class="option" id="option" value="" disabled selected>Select a doctor</option>
                      
                      <?php
                        
                        if ($result2->num_rows > 0) {
                           while ($row2 = $result2->fetch_assoc()) { 
                            echo "<option value=\"" . $row2["id"] . "--" . $row2["name"] . "\">" . $row2["name"] . "</option>";  
                           }
                          }
                      ?>

                  </select>


                <!-- <label for="doctors">Doctors</label>
                <select name="doctors" id="doctors">
                  <option hidden>Names</option>
                </select>
            -->
                         <label for="schedule">Appointment:</label>
                        <select name="schedule_details" id="schedule" required>
                          <option value="" disabled selected>Select an appointment slot</option>
                        </select>

                <!-- <input type="text" name="destination" id="destination" placeholder="Select an appointment slot"  required> -->

                <label for="address">Address</label>
                <input type="text" name="address" id="address"  required>

                <div class="row">
                  <div class="group_form">     
                    <label for="contact">Contact:</label>
                    <input type="tel" name="contact" id="contact" required>
                  </div>

                  <div class="group_form">
                    <label for="date_birth">Date of Birth:</label>
                    <input type="date" name="date_birth" id="date_birth" required>
                  </div>
                </div>

                <label for="remarks">Remarks:</label>
                <textarea name="remarks" id="remarks" rows="4"></textarea>
                
                <button  class="s" type="submit">Book Now</button>
            </form>

            <script>
    const doctorDropdown = document.getElementById("doctors");
    const scheduleDropdown = document.getElementById("schedule");

    doctorDropdown.addEventListener("change", () => {
        const doctorId = doctorDropdown.value;

        // Clear previous schedule options
        scheduleDropdown.innerHTML = '<option value="" disabled selected>Select an appointment slot</option>';

        // Fetch schedule slots for the selected doctor
        fetch(`learn.php?doctor_id=${doctorId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(slot => {
                    const option = document.createElement("option");
                    option.value = slot.schedule_id + "-->" + slot.date_time; // Use schedule_id for form submission
                    option.textContent = slot.date_time; // Display the date_time
                    scheduleDropdown.appendChild(option);
                });
            })
            .catch(error => console.error("Error fetching slots:", error));
    });

    
</script>

            
        </div>
    </div>

    <!-- why choose us -->

    <section class="section__container why__container" id="blog">
  <div class="why__image">
    <img src="istockphoto-1133919700-612x612.jpg" alt="Skin Care Treatment Image" />
  </div>
  <div class="why__content">
    <h2 class="section__header">Why Choose Us</h2>
    <p>
      At DermaCare Clinic, we are passionate about helping you achieve healthy, glowing skin. Our dedicated team of dermatology experts provides personalized care and cutting-edge treatments to meet your unique needs.
    </p>
    <div class="why__grid">
      <span><i class="ri-hand-heart-line"></i></span>
      <div>
        <h4>Advanced Skin Treatments</h4>
        <p>
          From acne to anti-aging, our advanced treatments are tailored to rejuvenate and revitalize your skin for long-lasting results.
        </p>
      </div>
      <span><i class="ri-truck-line"></i></span>
      <div>
        <h4>Free Consultation</h4>
        <p>
          Take the first step toward healthier skin with our free initial consultation, guided by experienced professionals.
        </p>
      </div>
      <span><i class="ri-hospital-line"></i></span>
      <div>
        <h4>Cosmetic Procedures</h4>
        <p>
          Enhance your natural beauty with our range of cosmetic dermatology services, including fillers, laser treatments, and more.
        </p>
      </div>
    </div>
  </div>
</section>



      <section class="section__container service__container" id="service">
        <div class="service__header">
          <div class="service__header__content">
            <h2 class="section__header">Our Special service</h2>
            <p>
              Beyond simply providing medical care, our commitment lies in
              delivering unparalleled service tailored to your unique needs.
            </p>
        </div>
        <button class="service__btn">Ask A Service</button>
      </div>
      <div class="service__grid">
        <div class="service__card">
          <span><i class="ri-microscope-line"></i></span>
          <h4>Carbon Peel</h4>
          <p>
            Accurate Diagnostics, Swift Results: Experience top-notch Laboratory
            Testing at our facility.
          </p>
          <a href="#">Consult Us</a>
          <img src="skinboss-eyescovered-acne-before-and-after-1.webp" alt="">
        </div>
        <div class="service__card">
          <span><i class="ri-mental-health-line"></i></span>
          <h4>Fractional CO2</h4>
          <p>
            Our thorough assessments and expert evaluations help you stay
            proactive about your health.
          </p>
          <a href="#">Consult Us</a>
          <img src="hq720.jpg" alt="">
        </div>
        <div class="service__card">
          <span><i class="ri-hospital-line"></i></span>
          <h4>Yellow Laser</h4>
          <p>
            Experience comprehensive oral care with Dentistry. Trust us to keep
            your smile healthy and bright.
          </p>
          <a href="#">Consult Us</a>
          <img src="BeforeAfters-Website-18.webp" alt="">
        </div>
      </div>
    </section>
      

    <footer class="footer">
  <div class="section__container footer__container">
    <div class="footer__col">
      <h3>Derma<span>Care</span> Clinic</h3>
      <p>
        At DermaCare Clinic, we are dedicated to providing expert dermatological care with a compassionate touch. Our mission is to enhance your confidence through healthy, radiant skin.
      </p>
      <p>
        Let us be your trusted partner in achieving optimal skin health and beauty, every step of the way.
      </p>
    </div>
    <div class="footer__col">
      <h4>Explore</h4>
      <p>Home</p>
      <p>About Us</p>
      <p>Careers</p>
      <p>Our Blog</p>
      <p>Policies</p>
    </div>
    <div class="footer__col">
      <h4>Our Services</h4>
      <p>Skin Treatments</p>
      <p>Advanced Procedures</p>
      <p>Laser Therapy</p>
      <p>Cosmetic Dermatology</p>
      <p>Consultations</p>
    </div>
    <div class="footer__col">
      <h4>Contact Us</h4>
      <p>
        <i class="ri-map-pin-2-fill"></i> 456, Rosewood Avenue, New York, USA
      </p>
      <p><i class="ri-mail-fill"></i> care@dermaclinic.com</p>
      <p><i class="ri-phone-fill"></i> (+123) 4567 890</p>
    </div>
  </div>
  <div class="footer__bar">
    <div class="footer__bar__content">
      <p>&copy; Rezaul Rafia Binte</p>
      <div class="footer__socials">
        <span><i class="ri-instagram-line"></i></span>
        <span><i class="ri-facebook-fill"></i></span>
        <span><i class="ri-twitter-fill"></i></span>
        <span><i class="ri-linkedin-fill"></i></span>
      </div>
    </div>
  </div>
</footer>

</body>
</html>