/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/views/**/*.blade.php",  // ✅ Scan all Blade files
      "./resources/views/*.blade.php", // ✅ Scan nested Blade files
      "./resources/js/*.js",  // ✅ Scan JavaScript files
      "./resources/css/*.css", // ✅ Scan any standalone CSS files
  ],
  theme: {
    extend: {
        colors:{
            primary: '#222e3e',
            secondary:'#6CA8F1',
            third:'#fafdfd',
            Black : '#000000',
            White :'#FFFFFF',

            gray_20:'#f4f7fe',
            gray_30:'#E9E2FF',
            white_70:'#F4F5F8',

            red:'#FC6441',
            green:'#28a745',
            blue_2:'#37BCF2',
            yellow:"#FF9E0E",
            purple:'#F2B1D6',
            gray_50:'#8C94A3',

        },


        fontFamily:{
            primary :'Roboto',
            secondary:'Epilogue',

        },


        boxShadow :{
            card:'0px 0px 8px 0px rgba(59, 130, 246, 0.12)' ,
            login:'3px 10px 15px 0px rgba(59, 130, 246 ,0.15)',
        },


        backgroundImage : {

            hero_login : 'url(../../resources/assets/login/login_img.png)',
            hero_logout : 'url(../../resources/assets/log_out/log_out.png)',
            hero_courses:'url(../../resources/assets/courses/hero_courses.png)',



        }
    },
  },
  plugins: [],
}

