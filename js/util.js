function system_grade(mark,data,is_rate) {

    for (var x=0;x<data.length;x++) {
       // var condition= mark+ data[x]['criteria'] +data[x]['grade_mark'];
       
        var condition=data[x]['grade_mark'] + data[x]['criteria'] +mark;
       // return condition;

    if(eval(condition)){
       // alert(data[x]['grade']+'_'+data[x]['grade_rate']);

        if(is_rate)
        return data[x]['grade_rate'];
        else
            return data[x]['grade']
    }
}
    return -1;
}
function overall_grade(se_mark,ca_mark,tot,data,is_rate) {
   // var ASG=system_grade(tot,data);
//alert('overall grade')
          return  system_grade(tot,data,is_rate);

}
function test() {
    
}
function result_grades(is_attend,absent_reson_approve,se_mark,ca_mark,tot,data) {
  
  if (ca_mark === '' || ca_mark === null){ // ca not submitted // ca absent
      if(is_attend==1){ //attended
          if(se_mark === '' || se_mark === null){
          } else if(se_mark<30){
              return 'INC';
          } else{
              return  'I(CA)';
          }
      } else { //absent
          if(absent_reson_approve==1){
              return 'I(CA)';
          }else {
              return 'AB';
          }
      }
      
  } else { // ca is 0 or more than 0
      if(is_attend==1){
        if(se_mark === '' || se_mark === null){
            
        }else if(se_mark<30){
            return 'I(SE)';
        } else{
            return  system_grade(tot,data,false);
        }
      } else {
          if(absent_reson_approve==1){
              return 'DFR';
          }else {
              return 'AB';
          }
      }
  }
  //////////////////////////
  
//    if(ca_mark>=0){// ca is 0 or more than 0
//      if(is_attend==1){
//        if(se_mark<30){
//            return 'I(SE)';
//        } else{
//            return  system_grade(tot,data,false);
//        }
//    }
//      else {
//          if(absent_reson_approve==1){
//              return 'DFR';
//          }else {
//              return 'AB';
//          }
//      }
//  }else{ // ca not submitted
//      console.info("ca not submit");
//       console.info("is att"+is_attend);
//      if(is_attend==1){
//          if(se_mark<30){
//              return 'INC';
//          } else{
//              return  'I(CA)';
//          }
//      }
//      else {
//          if(absent_reson_approve==1){
//              return 'I(CA)*';
//          }else {
//              return 'AB';
//          }
//      }
//  }


}