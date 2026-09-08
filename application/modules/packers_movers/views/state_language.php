<?php
$phone="<a href=''.$phonehtml>.$phone</a>";
if(strtolower($state)=="west bengal"){
    $lang="Bengali";
    $lang_text="<h3>প্যাকার এবং মুভার্স পরিষেবার জন্য, কল করুন $phone</h3>";
}
else if(strtolower($state)=="odisha"){
    $lang="Odia";
    $lang_text="<h3>ପ୍ୟାକର୍ସ ଏବଂ ମୁଭର୍ସ ସେବା ପାଇଁ, କଲ୍ କରନ୍ତୁ $phone</h3>";
}
else if(strtolower($state)=="maharashtra"){
    $lang="Marathi";
    $lang_text="<h3>पॅकर्स आणि मूव्हर्स सेवांसाठी, कॉल करा $phone</h3>";
}
else if(strtolower($state)=="punjab"){
    $lang="Punjabi";
    $lang_text="<h3>ਪੈਕਰ ਅਤੇ ਮੂਵਰ ਸੇਵਾਵਾਂ ਲਈ, ਕਾਲ ਕਰੋ $phone</h3>";
}
else if(strtolower($state)=="gujarat"){
    $lang="Gujarati";
    $lang_text="<h3>પેકર્સ અને મૂવર્સ સેવાઓ માટે, કૉલ કરો $phone</h3>";
}
else if(strtolower($state)=="karnataka"){
    $lang="Kanada";
    $lang_text="<h3>ಪ್ಯಾಕರ್ಸ್ ಮತ್ತು ಮೂವರ್ಸ್ ಸೇವೆಗಳಿಗಾಗಿ $phone ಗೆ ಕರೆ ಮಾಡಿ</h3>";
}
else if(strtolower($state)=="telangana" || strtolower($state)=="andhra pradesh"){
    $lang="Telugu";
    $lang_text="<h3>ప్యాకర్స్ మరియు మూవర్స్ సర్వీస్‌ల కోసం $phone కి కాల్ చేయండి</h3>";
}
else if(strtolower($state)=="tamil nadu"){
    $lang="Tamil";
    $lang_text="<h3>பேக்கர்ஸ் மற்றும் மூவர்ஸ் சேவைகளுக்கு $phone ஐ அழைக்கவும்</h3>";
}
else if(strtolower($state)=="kerala"){
    $lang="Malayalam";
    $lang_text="<h3>പാക്കേഴ്‌സ് ആൻഡ് മൂവേഴ്‌സ് സേവനങ്ങൾക്ക് $phone എന്ന നമ്പറിൽ വിളിക്കുക</h3>";
}
else if(strtolower($state)=="sikkim"){
    $lang="Nepali";
    $lang_text="<h3>प्याकर र मूभर्स सेवाहरूको लागि $phone मा कल गर्नुहोस्</h3>";
}
else if(strtolower($state)=="assam"){
    $lang="Assamese";
    $lang_text="<h3>চাৰিজন পেকাৰ আৰু মুভৰ্ছ সেৱা অনুগ্ৰহ কৰি $phone ত ফোন কৰক</h3>";
}
else { 
    $lang="Hindi";
    $lang_text="<h3>पैकर्स एंड मूवर्स सेवाओं के लिए कॉल करें $phone</h3>";
}