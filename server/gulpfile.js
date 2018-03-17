var gulp = require('gulp');
var cssSprite = require('gulp-css-spritesmith');

gulp.task('default', function() {
  // 将你的默认的任务代码放在这
});

// 自动雪碧图
gulp.task('autoSprite', function() {
    gulp.src('public/dist/css/app.css').pipe(cssSprite({
        // sprite背景图源文件夹，只有匹配此路径才会处理，默认 images/slice/
        imagepath: 'public/dist/image/',
        // 映射CSS中背景路径，支持函数和数组，默认为 null
        imagepath_map: null,
        // 雪碧图输出目录，注意，会覆盖之前文件！默认 images/
        spritedest: 'public/dist/image/',
        // 替换后的背景路径，默认 ../images/
        spritepath: '../image/',
        // 各图片间间距，如果设置为奇数，会强制+1以保证生成的2x图片为偶数宽高，默认 0
        padding: 2,
        // 是否使用 image-set 作为2x图片实现，默认不使用
        useimageset: false,
        // 是否以时间戳为文件名生成新的雪碧图文件，如果启用请注意清理之前生成的文件，默认不生成新文件
        newsprite: false,
        // 给雪碧图追加时间戳，默认不追加
        spritestamp: false,
        // 在CSS文件末尾追加时间戳，默认不追加
        cssstamp: false
    }))
    .pipe(gulp.dest('public/dist/css/'));
});