export async function apiGetService(route){
    return axios.get( route )
    .then(responseBody => {
      console.log('response', responseBody);
      if (
        responseBody.status !== 200 
      ) {
        console.log('Something went wrong.');
      }
      return responseBody;
    })
}

export async function apiPostService(route, body){
  console.log("ewsdf2erw23rew",body, route);
    return axios.post( route, JSON.stringify(body))
    .then(responseBody => {
      console.log('response', responseBody);
      if (
        responseBody.status !== 200 
      ) {
        console.log('Something went wrong.');
      }
      return responseBody;
    })
}