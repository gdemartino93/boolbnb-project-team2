import{_ as f,A as g,s as y,e as x,f as c,o as a,c as u,a as t,d as i,v as l,h as _,b as C,F as q,i as V,j as L,p as k,l as w}from"./index-865bb9d6.js";const A="/assets/noun-apartment-194955-2899f180.png";const S={components:{AptCard:g},data(){return{store:y,queryValue:"",queryLatitude:"",queryLongitude:"",apartments:[],radius:20,error:null,room_number:"",bed_number:"",isOpen:!1}},methods:{getCoordinates(o){o.preventDefault();var e=`${this.store.geolocationUrl}`+this.queryValue+`.json?key=${this.store.apiKey}`,r=new XMLHttpRequest;r.open("GET",e,!1),r.send(null);var d=JSON.parse(r.responseText);this.queryLatitude=parseFloat(d.results[0].position.lat),this.queryLongitude=parseFloat(d.results[0].position.lon),console.log(this.queryLatitude,this.queryLongitude),this.getApt()},getApt(){let o=new FormData;o.append("latitude",this.queryLatitude),o.append("longitude",this.queryLongitude),o.append("radius",this.radius),o.append("room_number",this.room_number),o.append("bed_number",this.bed_number),console.log(o),x.post("/api/v1/apartment/search",o).then(e=>{console.log("apSear",e),this.apartments=e.data.apartments,this.$emit("apartments-searched",this.apartments),console.log(this.apartments),this.apartments.length==0?this.error="nessun appartamento trovato":this.error=null})}},mounted(){}},h=o=>(k("data-v-c6c05248"),o=o(),w(),o),N={class:"search"},O={class:"container",id:"form"},U={action:"",method:"post"},B={class:"button"},F={class:"wrap-ricerca d-flex"},D={class:"d-flex box-ricerca align-items-center"},I={key:0,class:"menu"},j=h(()=>t("img",{src:A,alt:"room number logo"},null,-1)),T=h(()=>t("label",{for:"range"},"O in alternativa puoi cambiare il range di ricerca (il valore di default è di 20Km):",-1)),E={class:"container d-flex flex-wrap"};function H(o,e,r,d,n,p){const m=c("font-awesome-icon"),v=c("AptCard");return a(),u("div",N,[t("div",O,[t("form",U,[t("div",B,[t("div",F,[t("div",D,[i(t("input",{type:"search",name:"searchBar",placeholder:"Cosa stai cercando?","onUpdate:modelValue":e[0]||(e[0]=s=>n.queryValue=s),id:"ricerca"},null,512),[[l,n.queryValue]]),_(m,{icon:"fa-solid fa-filter",onClick:e[1]||(e[1]=s=>n.isOpen=!0),id:"icona-ricerca"})]),t("div",null,[t("input",{class:"btn btn-info mx-2",type:"submit",value:"Cerca",onClick:e[2]||(e[2]=(...s)=>p.getCoordinates&&p.getCoordinates(...s)),id:"cerca"})])]),n.isOpen?(a(),u("div",I,[t("div",null,[j,i(t("input",{type:"number",name:"room_number","onUpdate:modelValue":e[3]||(e[3]=s=>n.room_number=s),placeholder:"Numero minimo di camere ..."},null,512),[[l,n.room_number]])]),t("div",null,[_(m,{icon:"fa-solid fa-bed",id:"bed"}),i(t("input",{type:"number",name:"bed_number","onUpdate:modelValue":e[4]||(e[4]=s=>n.bed_number=s),placeholder:"Numero minimo di letti ..."},null,512),[[l,n.bed_number]])]),t("div",null,[T,i(t("input",{type:"range",name:"range",min:"20",max:"100",step:"20","onUpdate:modelValue":e[5]||(e[5]=s=>n.radius=s)},null,512),[[l,n.radius]])]),t("div",{class:"buttonClose",onClick:e[6]||(e[6]=s=>n.isOpen=!1)}," Close ")])):C("",!0)])])]),t("div",E,[(a(!0),u(q,null,V(n.apartments,(s,b)=>(a(),L(v,{class:"my-4 col-12 col-sm-6 col-md-4 col-lg-3",apartment:s,key:b},null,8,["apartment"]))),128))])])}const M=f(S,[["render",H],["__scopeId","data-v-c6c05248"]]);export{M as default};