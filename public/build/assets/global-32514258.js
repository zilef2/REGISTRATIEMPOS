import"./app-dd94624b.js";function $(e,t){if(e===null)return null;let r="";if(typeof t=="string"){for(const n of e)if(n.title===t){console.log("🧈 "+n.value+" searchValue:",t),r=n.value;break}}else for(const n of e)if(n.title===t.title){r=n.value;break}return r}function p(e,t){let r=new Date(e);r=new Date(r.getTime()+5*60*60*1e3);const n=r.getDate().toString().padStart(2,"0"),i=c((r.getMonth()+1).toString().padStart(2,"0"));let o=r.getFullYear(),l=new Date().getFullYear();if(t=="conLaHora"){let a=r.getHours();const u=a>=12?" PM":" AM";a=a%12||12;let s=a+":"+(r.getMinutes()<10?"0":"")+r.getMinutes()+u;if(l==o)return`${n}-${i} | ${s}`;{let f=o.toString().slice(-2);return`${n}-${i}-${f} | ${s}`}}else{if(l==o)return`${n}-${i}`;{let a=o.toString().slice(-2);return`${n}-${i}-${a}`}}}function d(e){if(e===null)return"";const[t,r,n]=e.split(":");return new Date(2023,7,5,parseInt(t),parseInt(r)).toLocaleString("es-CO",{hour:"numeric",minute:"2-digit",hour12:!0})}function D(e){let t;e?t=new Date(e):t=new Date;let r=t.getHours();return`${(r<10?"0":"")+r+":"+(t.getMinutes()<10?"0":"")+t.getMinutes()+":00"}`}function c(e){if(e==1)return"Enero";if(e==2)return"Febrero";if(e==3)return"Marzo";if(e==4)return"Abril";if(e==5)return"Mayo";if(e==6)return"Junio";if(e==7)return"Julio";if(e==8)return"Agosto";if(e==9)return"Septiembre";if(e==10)return"Octubre";if(e==11)return"Noviembre";if(e==12)return"Diciembre"}function F(e){const t=new Date(e),r=t.getFullYear(),n=("0"+(t.getMonth()+1)).slice(-2),i=("0"+t.getDate()).slice(-2),o=("0"+t.getHours()).slice(-2),l=("0"+t.getMinutes()).slice(-2);return`${r}-${n}-${i}T${o}:${l}`}function M(e,t,r){if(e+="",e=parseFloat(e.replace(/[^0-9\.]/g,"")),t=t||0,isNaN(e)||e===0)return parseFloat("0").toFixed(t);e=""+e.toFixed(t);for(var n=e.split(" "),i=/(\d+)(\d{3})/;i.test(n[0]);)n[0]=n[0].replace(i,"$1.$2");return r?"$"+n.join(" "):n.join(" ")}function w(e){const t=new Date().getFullYear(),r=new Date(e).getFullYear();return t-r}function v(e,t=10){if(e){const r=e.split(" ");return r.length>t?r.slice(0,t).join(" ")+"...":e}}function A(e,t,r="uno"){return e=t.map(n=>({label:n.nombre,value:n.id})),e.unshift({label:"Seleccione "+r,value:0}),e}export{w as C,$ as L,v as P,F as T,D as a,d as b,p as f,M as n,A as v};
