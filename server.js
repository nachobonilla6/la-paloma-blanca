const express = require('express');
const path = require('path');
const fs = require('fs');

const app = express();
const PORT = process.env.PORT || 3000;

const publicDir = path.resolve(__dirname, 'public');
const photosDir = path.resolve(__dirname, 'photos');

// Debug middleware
app.use((req, res, next) => {
  console.log(`[${req.method}] ${req.url}`);
  next();
});

// Serve everything from public/ first (CSS, JS, etc.)
app.use(express.static(publicDir));

// Photos route - explicit middleware for /photos/*
app.use('/photos', (req, res, next) => {
  // Remove /photos/ prefix
  const relativePath = req.url.replace(/^\//, '');
  const filePath = path.join(photosDir, relativePath);
  console.log(`  Trying photos: ${filePath} (exists: ${fs.existsSync(filePath)})`);
  if (fs.existsSync(filePath)) {
    res.sendFile(filePath);
  } else {
    next();
  }
});

// Main route
app.get('/', (req, res) => {
  res.sendFile(path.join(publicDir, 'index.html'));
});

// Health check
app.get('/health', (req, res) => {
  res.status(200).send('OK');
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`La Paloma Blanca site running on port ${PORT}`);
});
