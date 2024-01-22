import axios from "axios"

const rest = axios.create({
  baseURL: "http://localhost:8080/",
})

export const getColumns = /*async*/ () => {

  return [
        {
          id: 1,
          title: "Kanban Column 1",
          cards: [
            {
              id: 1,
              title: "Kanban Column Card 1",
              description: "Kanban Board Card 1 Description",
            }
          ]
        },
        {
          id: 2,
          title: "Kanban Column 2",
          cards: [
            {
              id: 2,
              title: "Kanban Column Card 2",
              description: "Kanban Board Card 2 Description",
            }
          ]
        }
      ]

  /*try {
    return (await rest.get("/Residents")).data;
  } catch (err) {
    console.error(err.toJSON());
    throw new Error(err.message);
  }*/
}

export const updateCard = async () => {
  try {
    return (await rest.post("/Residents")).data;
  } catch (err) {
    console.error(err.toJSON());
    throw new Error(err.message);
  }
}

export const updateColumns = async () => {
  try {
    return (await rest.post("/Residents")).data;
  } catch (err) {
    console.error(err.toJSON());
    throw new Error(err.message);
  }
}