export default function getTemplate(siteKey) {
  return `
    <br/>
    <h2 style="text-align: center">留言板Plugin練習</h2>
    <br/>
    <session class="card">      
      <form class="${siteKey}-add-comment-form card-body" method="POST">
        <div class="mb-3 ">
          <label class="form-label">您的暱稱</label>
          <input name="nickname" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">留言內容</label>
          <textarea name="content" class="form-control" rows="3"></textarea>
        </div>
        <div style="text-align: right">
          <button type="submit" class="btn btn-warning btn-lg">確認送出</button>
        </div>        
      </form>      
    </session>
    <div class="progress">
      <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br/>    
    <div class="${siteKey}-comments row row-cols-1 row-cols-md-2 g-4">
    </div>
    <br/>
    <div class="text-center ${siteKey}-load-more">
    </div>
    <br/> 
  `
}
