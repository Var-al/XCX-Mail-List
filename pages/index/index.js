import request from '../../utils/request'

Page({

  /**
   * 页面的初始数据
   */
  data: {
    page:1,
    noData:false,
    cateid:0,
    index:0,
    CateArray: [],
    personlist:[]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) 
  {
    var that = this  //onLoad

    //发送一个get请求 then然后
    request.get('/index.php?action=catelist').then(function(result){
      that.setData({
        CateArray:result
      })
    })

    //获取名片列表
    this.personlist()
  },
  onShow: function (options) 
  {
    var that = this  //onLoad

    //发送一个get请求 then然后
    request.get('/index.php?action=catelist').then(function(result){
      that.setData({
        CateArray:result
      })
    })

    //获取名片列表
    this.personlist()
  },
  personlist()
  {
    var that = this

    //获取到分页
    var page = this.data.page

    var requestData = {
      'cateid':this.data.cateid,
      'page':page
    }

    //发送一个get请求 then然后
    request.get('/index.php?action=personlist',requestData).then(function(result){

      if(result.length > 0)
      {
        //将数据合并
        var personlist = that.data.personlist.concat(result)

        that.setData({
          personlist:personlist,
          page:page+1
        })
      }else{
        that.setData({
          noData:true
        })
      }

    })
  },

  //切换选项
  clickTab(e)
  {
    this.setData({
      cateid:e.currentTarget.dataset.cateid
    })

    this.personlist();
  },

  //触发下拉动作
  onPullDownRefresh()
  {
    this.setData({
      personlist:[],
      page:1,
      noData:false
    })

    //重新获取最新的数据
    this.personlist()
  },
  //触发上拉动作
  onReachBottom()
  {
    this.personlist()
  }
})