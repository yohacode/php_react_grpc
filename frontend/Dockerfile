FROM node:18

WORKDIR /app
COPY . .
RUN npm install && npm run build

EXPOSE 3000
CMD ["npm", "start"]