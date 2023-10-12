import axios from "axios";
if (localStorage.getItem("token")) {
  axios.defaults.headers.common["Authorization"] =
    "Bearer " + localStorage.getItem("token");
}
// axios.defaults.headers.common is an object that holds headers to be sent with every Axios request.
// "Authorization" is the header key for authentication.
// "Bearer " is the authentication scheme typically used with tokens.
// localStorage.getItem("token") retrieves the token stored in the localStorage.
// la kotayya la logout function requestek dakaynawa bo data useraka gar tokena rastakay pebw awa basha wa nabw asretawa
export default axios.create({
  baseURL: "http://127.0.0.1:8000/api/",
});
