const express = require('express');
const path = require('path');
const fs = require('fs');
const helmet = require('helmet');
const rateLimit = require('express-rate-limit');

const app = express();
const PORT = process.env.PORT || 3000;

const publicDir = path.resolve(__dirname, 'public');
const photosDir = path.resolve(__dirname, 'photos');

// Security headers
app.use(helmet({
  crossOriginResourcePolicy: { policy: 'cross-origin' },
  contentSecurityPolicy: false
}));

// Rate limiting
const limiter = rateLimit({
  windowMs: 15 * 60 * 1000,
  max: 200,
  standardHeaders: true,
  legacyHeaders: false,
  message: 'Too many requests, please try again later.'
});
app.use(limiter);

// Debug middleware
app.use((req, res, next) => {
  console.log(`[${req.method}] ${req.url}`);
  next();
});

// Serve everything from public/ first (CSS, JS, etc.)
app.use(express.static(publicDir));

// Photos route - safe from path traversal
app.use('/photos', (req, res, next) => {
  const relativePath = req.url.replace(/^\//, '');
  const fullPath = path.resolve(photosDir, relativePath);

  // Ensure resolved path stays inside photosDir
  if (!fullPath.startsWith(photosDir)) {
    return res.status(403).send('Forbidden');
  }

  console.log(`  Trying photos: ${fullPath} (exists: ${fs.existsSync(fullPath)})`);
  if (fs.existsSync(fullPath)) {
    res.sendFile(fullPath);
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
