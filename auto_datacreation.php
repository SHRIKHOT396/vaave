<?php
$users = [];
$userAlumni = [];
$institutes = [1, 2, 3, 4, 5];
$alumniNetworks = [1, 2, 3, 4, 5];

// Expanded names and locations for diversity
$firstNames = [
    // A
    'Amit', 'Anita', 'Anjali', 'Arjun', 'Aarti', 'Akshay', 'Akhil', 'Aditya', 'Amrita', 'Aryan',
    // B
    'Bhavna', 'Bharat', 'Bhavesh', 'Bina', 'Bijoy', 'Bhuvan', 'Brijesh', 'Babita', 'Bimal', 'Bobby',
    // C
    'Chandni', 'Chetan', 'Chirag', 'Charu', 'Chaya', 'Chandan', 'Chitra', 'Chetana', 'Chaitanya', 'Chinmay',
    // D
    'Deepak', 'Divya', 'Dipti', 'Dinesh', 'Disha', 'Darshan', 'Devika', 'Dilip', 'Devendra', 'Dheeraj',
    // E
    'Esha', 'Ekta', 'Eklavya', 'Eshwar', 'Elina', 'Eshan', 'Ekansh', 'Ekagrah', 'Ekveera', 'Esita',
    // F
    'Farhan', 'Fatima', 'Faisal', 'Firoz', 'Falguni', 'Fazal', 'Firoza', 'Firdaus', 'Faheem', 'Farida',
    // G
    'Gaurav', 'Gita', 'Govind', 'Gulshan', 'Ganesh', 'Gayatri', 'Gopal', 'Geeta', 'Garima', 'Gyanesh',
    // H
    'Harsha', 'Harsh', 'Hemant', 'Hema', 'Himani', 'Harinder', 'Harish', 'Hetal', 'Harsha', 'Heena',
    // I
    'Isha', 'Ishaan', 'Iqbal', 'Imran', 'Inaaya', 'Irfan', 'Ishita', 'Inder', 'Indira', 'Idris',
    // J
    'Jyoti', 'Jaya', 'Jitendra', 'Jasmine', 'Jagdish', 'Jaideep', 'Jatin', 'Jahnvi', 'Jagruti', 'Janki',
    // K
    'Kavya', 'Karan', 'Kirti', 'Kunal', 'Komal', 'Kiran', 'Krishna', 'Kajal', 'Kartik', 'Kavita',
    // L
    'Lata', 'Lalit', 'Lakshmi', 'Lokesh', 'Leela', 'Lavanya', 'Laxman', 'Laxmi', 'Liza', 'Lohit',
    // M
    'Manisha', 'Meena', 'Mohit', 'Mitali', 'Manoj', 'Madhuri', 'Mukesh', 'Mahesh', 'Mayank', 'Mehul',
    // N
    'Neha', 'Nisha', 'Nitin', 'Naveen', 'Nandini', 'Nilesh', 'Namrata', 'Narendra', 'Niharika', 'Nakul',
    // O
    'Om', 'Omkar', 'Ojas', 'Ojaswi', 'Omesh', 'Omprakash', 'Ojasvini', 'Ojaswin', 'Omika', 'Omya',
    // P
    'Pooja', 'Priya', 'Payal', 'Pankaj', 'Parul', 'Prakash', 'Preeti', 'Pallavi', 'Pranav', 'Pranjal',
    // Q
    'Qasim', 'Qadir', 'Qamar', 'Qudsia', 'Quaiser', 'Quasim', 'Qutub', 'Quraish', 'Qutbuddin', 'Quintin',
    // R
    'Rohan', 'Ravi', 'Rajesh', 'Rakesh', 'Rekha', 'Rupali', 'Ranjit', 'Radha', 'Rahul', 'Ramesh',
    // S
    'Sneha', 'Swati', 'Suresh', 'Siddharth', 'Sachin', 'Seema', 'Sunita', 'Sanjay', 'Sakshi', 'Sharad',
    // T
    'Tanya', 'Tarun', 'Tanvi', 'Tushar', 'Tejas', 'Tina', 'Trisha', 'Tanu', 'Tanmay', 'Tulika',
    // U
    'Usha', 'Utkarsh', 'Ujjwal', 'Umang', 'Upasana', 'Umesh', 'Urmi', 'Unnati', 'Uma', 'Uday',
    // V
    'Vikram', 'Vidya', 'Varun', 'Vivek', 'Vandana', 'Vaibhav', 'Vibhuti', 'Vikas', 'Vani', 'Viral',
    // W
    'Wasim', 'Waris', 'Wajid', 'Waseem', 'Warsha', 'Wafiya', 'Wahid', 'Wasifa', 'Wali', 'Walid',
    // X (Limited Indian names with X, adding meaningful ones)
    'Xavier', 'Xara', 'Xena', 'Xahid', 'Xiya', 'Xina', 'Xanesh', 'Xinta', 'Xamesh', 'Xendra',
    // Y
    'Yash', 'Yamini', 'Yogesh', 'Yuvraj', 'Yashika', 'Yuvika', 'Yashwant', 'Yagna', 'Yashas', 'Yukta',
    // Z
    'Zara', 'Zaid', 'Zain', 'Zoya', 'Zarina', 'Zubair', 'Zaheer', 'Zainab', 'Zubina', 'Zakir'
];


$lastNames = [
    // A
    'Agarwal', 'Anand', 'Acharya', 'Ahuja', 'Apte', 'Arya', 'Ajmera', 'Adhikari', 'Ankola', 'Asrani',
    // B
    'Bajaj', 'Bansal', 'Basu', 'Bhandari', 'Bhatt', 'Bhattacharya', 'Bose', 'Bhalerao', 'Bakshi', 'Barua',
    // C
    'Chopra', 'Chawla', 'Chaturvedi', 'Chaudhary', 'Chand', 'Choksi', 'Chahal', 'Chhibber', 'Chitre', 'Chari',
    // D
    'Das', 'Dutta', 'Desai', 'Deshmukh', 'Dhawan', 'Dewan', 'Dholakia', 'Dubey', 'Daga', 'Damle',
    // E
    'Ediga', 'Ekbote', 'Edathil', 'Eipe', 'Elangovan', 'Ekka', 'Erande', 'Eranki', 'Easwaran', 'Eashwar',
    // F
    'Fakir', 'Farooqui', 'Fatima', 'Firoz', 'Fatehpuria', 'Farooq', 'Faria', 'Fathima', 'Fazal', 'Firdous',
    // G
    'Gupta', 'Ghosh', 'Gokhale', 'Goyal', 'Gandhi', 'Gaikwad', 'Gill', 'Gadgil', 'Gogoi', 'Gawande',
    // H
    'Hooda', 'Hegde', 'Harikrishna', 'Hansraj', 'Halder', 'Hussain', 'Hiremath', 'Halai', 'Hiranandani', 'Halgekar',
    // I
    'Iyer', 'Iyengar', 'Irani', 'Islam', 'Ingle', 'Irfan', 'Indoria', 'Indurkar', 'Indukuri', 'Ismail',
    // J
    'Joshi', 'Jain', 'Jadhav', 'Jhala', 'Jagtap', 'Jha', 'Jogi', 'Jaitly', 'Jambhekar', 'Jamwal',
    // K
    'Kumar', 'Khanna', 'Kapoor', 'Kohli', 'Kashyap', 'Kaul', 'Kadakia', 'Kamble', 'Kamat', 'Kansal',
    // L
    'Lal', 'Laxman', 'Lokhande', 'Lohia', 'Lakra', 'Lodha', 'Lalwani', 'Langarkar', 'Lekhi', 'Lata',
    // M
    'Mehta', 'Malhotra', 'Mishra', 'Mohan', 'Menon', 'Mukherjee', 'Mahajan', 'Mankad', 'Mazumdar', 'Mangal',
    // N
    'Nair', 'Nayak', 'Nag', 'Naik', 'Narayan', 'Nambiar', 'Nadkarni', 'Nene', 'Nagarkar', 'Nadig',
    // O
    'Oberoi', 'Ojha', 'Oswal', 'Oza', 'Omprakash', 'Oke', 'Ojhal', 'Onkar', 'Odhikar', 'Odhekar',
    // P
    'Patel', 'Pandey', 'Puri', 'Prasad', 'Panchal', 'Pawar', 'Pal', 'Phadke', 'Pathak', 'Pancholi',
    // Q
    'Quadri', 'Quadir', 'Qureshi', 'Qadir', 'Quadriwala', 'Qazi', 'Qutubuddin', 'Qaid', 'Quaiser', 'Qutb',
    // R
    'Roy', 'Reddy', 'Rana', 'Rathore', 'Rawat', 'Rajput', 'Rastogi', 'Ram', 'Rao', 'Raman',
    // S
    'Sharma', 'Singh', 'Saxena', 'Shukla', 'Srinivasan', 'Shetty', 'Sen', 'Sinha', 'Sarkar', 'Sardesai',
    // T
    'Tiwari', 'Tripathi', 'Thakur', 'Talwar', 'Tamboli', 'Tendulkar', 'Taneja', 'Tamhane', 'Tandon', 'Takalkar',
    // U
    'Upadhyay', 'Umrani', 'Udupa', 'Uppal', 'Usmani', 'Utgikar', 'Uthappa', 'Umap', 'Udwadia', 'Ulhas',
    // V
    'Verma', 'Vyas', 'Vora', 'Venkatesh', 'Vishwakarma', 'Vishwanath', 'Varma', 'Venkata', 'Vijayan', 'Vaidya',
    // W
    'Wagle', 'Warrier', 'Wadhwa', 'Wani', 'Wankhede', 'Wadia', 'Wadkar', 'Wable', 'Waseem', 'Wankhedekar',
    // X (Limited Indian surnames with X, using unique names)
    'Xavier', 'Xalxo', 'Ximena', 'Xinhai', 'Xia', 'Xaid', 'Xathar', 'Xenith', 'Xevier', 'Xin',
    // Y
    'Yadav', 'Yashwant', 'Yarlagadda', 'Yamuna', 'Yardi', 'Yegnanarayan', 'Yerawadekar', 'Yadavendra', 'Yerkar', 'Yellappa',
    // Z
    'Zaveri', 'Zaidi', 'Zafar', 'Zaman', 'Zubair', 'Zahra', 'Zahid', 'Zameer', 'Zaki', 'Zaheer'
];


$locations = [
    ['city' => 'Mumbai', 'lat' => 19.0760, 'lng' => 72.8777],
    ['city' => 'Delhi', 'lat' => 28.7041, 'lng' => 77.1025],
    ['city' => 'Chennai', 'lat' => 13.0827, 'lng' => 80.2707],
    ['city' => 'Lucknow', 'lat' => 26.8467, 'lng' => 80.9462],
    ['city' => 'Kolkata', 'lat' => 22.5726, 'lng' => 88.3639],
    ['city' => 'Pune', 'lat' => 18.5204, 'lng' => 73.8567],
    ['city' => 'Bangalore', 'lat' => 12.9716, 'lng' => 77.5946],
    ['city' => 'Hyderabad', 'lat' => 17.3850, 'lng' => 78.4867],
    ['city' => 'Ahmedabad', 'lat' => 23.0225, 'lng' => 72.5714],
    ['city' => 'Jaipur', 'lat' => 26.9124, 'lng' => 75.7873],
    ['city' => 'Surat', 'lat' => 21.1702, 'lng' => 72.8311],
    ['city' => 'Nagpur', 'lat' => 21.1458, 'lng' => 79.0882],
    ['city' => 'Indore', 'lat' => 22.7196, 'lng' => 75.8577],
    ['city' => 'Bhopal', 'lat' => 23.2599, 'lng' => 77.4126],
    ['city' => 'Vadodara', 'lat' => 22.3072, 'lng' => 73.1812],
    ['city' => 'Coimbatore', 'lat' => 11.0168, 'lng' => 76.9558],
    ['city' => 'Thiruvananthapuram', 'lat' => 8.5241, 'lng' => 76.9366],
    ['city' => 'Patna', 'lat' => 25.5941, 'lng' => 85.1376],
    ['city' => 'Ranchi', 'lat' => 23.3441, 'lng' => 85.3096],
    ['city' => 'Raipur', 'lat' => 21.2514, 'lng' => 81.6296],
    ['city' => 'Guwahati', 'lat' => 26.1445, 'lng' => 91.7362],
    ['city' => 'Dehradun', 'lat' => 30.3165, 'lng' => 78.0322],
    ['city' => 'Shimla', 'lat' => 31.1048, 'lng' => 77.1734],
    ['city' => 'Agra', 'lat' => 27.1767, 'lng' => 78.0081],
    ['city' => 'Kanpur', 'lat' => 26.4499, 'lng' => 80.3319],
    ['city' => 'Varanasi', 'lat' => 25.3176, 'lng' => 82.9739],
    ['city' => 'Nashik', 'lat' => 19.9975, 'lng' => 73.7898],
    ['city' => 'Aurangabad', 'lat' => 19.8762, 'lng' => 75.3433],
    ['city' => 'Rajkot', 'lat' => 22.3039, 'lng' => 70.8022],
    ['city' => 'Amritsar', 'lat' => 31.6340, 'lng' => 74.8723],
    ['city' => 'Jodhpur', 'lat' => 26.2389, 'lng' => 73.0243],
];
for ($i = 1; $i <= 100000; $i++) {
    // Generate random name
    $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];

    // Generate unique email
    $email = strtolower(str_replace(' ', '.', $name)) . '.' . $i . '@example.com';

    // Generate realistic location within city bounds
    $location = $locations[array_rand($locations)];
    $latitude = $location['lat'] + ((mt_rand(-1000, 1000)) / 10000);
    $longitude = $location['lng'] + ((mt_rand(-1000, 1000)) / 10000);

    // Assign to a random institute
    $institute = $institutes[array_rand($institutes)];
    $users[] = "($i, '$name', '$email', $latitude, $longitude, NOW(), NOW(), POINT($longitude, $latitude), $institute)";

    // Generate multiple alumni network associations
    $numAssociations = mt_rand(1, 3);
    for ($j = 0; $j < $numAssociations; $j++) {
        $alumniNetwork = $alumniNetworks[array_rand($alumniNetworks)];
        $userAlumni[] = "($i, $alumniNetwork)";
    }
}

// Save the queries to files
file_put_contents('users.sql', "INSERT INTO `users` (`id`, `name`, `email`, `latitude`, `longitude`, `created_at`, `updated_at`, `location`, `institute_id`) VALUES\n" . implode(",\n", $users) . ";\n");
file_put_contents('user_alumni.sql', "INSERT INTO `user_alumni` (`user_id`, `alumni_network_id`) VALUES\n" . implode(",\n", $userAlumni) . ";\n");
echo "SQL files generated successfully!";
?>
